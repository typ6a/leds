<?php

namespace App\Libs;

use Symfony\Component\DomCrawler\Crawler as Crawler;

class UpdateProductsCrawler {

    protected $base_url = 'http://newhtf.ru';

    //protected $base_url = null;

    public function execute() {
        $products = \App\Models\Product::where('processed', 0)->get();
        
        foreach ($products as $product) {
            /*
            $response = @file_get_contents($product->url);
            //pre($http_response_header,1);
            $response_code = (int) explode(' ', $http_response_header[0])[1];
            if (trim($response) || ($response_code > 400 && $response_code < 500)) {
                //$product->delete();
                continue;
            }
            */

            $url = $product->url;
            //$url = 'http://newhtf.ru/catalog/ofisnoe-ulichnoe-promyshlennoe/ofisnye_svetodiodnye_svetilniki_1200kh180_s_prizmaticheskim_steklom/svetodiodnyy_svetilnik_potolochnyy_s_prizmaticheskim_steklom_1200_180_40_24w_220v_ip40_ep_cw.html';
            $html = file_get_contents($url);

            $this->crawler = new Crawler($html);
            $product->price = $this->parseProductPrice();

            if ($product->price == null) {
                $product->price=0;
            }
            
            $product->images()->saveMany($this->parseProductImages($product));

            $productProperties = $this->parseProductProperties($product);

            $product->properties()->saveMany($productProperties);



            $product->processed = 1;
            $product->save();
            //exit('sdfdsf');
            sleep(1);
        }
        pre('dine done', 1);
    }

    protected function parseProductPrice() {
        $price = $this->crawler->filter('.item_detail_options  .price > .allSumMain');
        if ($price->count()) {
            return (double) str_replace(' ', '', $price->text());
        }
    }

    protected function parseProductImages($product) {
        $images = [];
        $items = $this->crawler->filter('.item_gal a > img');
        
        if ($items->count()) {
            $items->each(function (Crawler $image, $i) use (&$images, $product) {
                
                $url = str_replace('resizer2/6', 'resizer2/2', $image->attr('src'));
                $parts = explode('?', $url);
                $url = (string) array_shift($parts); 
                $imageUrl = 'http://' . trim($url, '/');
                $filename = $product->category_id . '.' . $i . '.jpg'; 
                $images[] = new \App\Models\ProductImage([
                    'url' => $imageUrl,
                    'filename' => $filename
                ]);                
                 // save image to local HDD                    
                    $filepath = 'd:\workspace\leds\public\data\images\\' . $filename;
                  
                    file_put_contents($filepath, file_get_contents($imageUrl));
                //pre($images);
                               
        
            });
           
        } return $images;
    }
      
    protected function parseProductProperties($product) {
        //$productProperties = [];
        $properties = [];
        $propertyRows = $this->crawler->filter('.yeni_ipep_props_groups table tbody tr.prop_line');
        //pre($propertyRow,1);
        //$propertyValue = $this->crawler->filter('.yeni_ipep_props_groups table tbody .prop_line > td:last-child');
        //pre($propertyValue, 1);

        if ($propertyRows->count()) {
            $propertyRows->each(function (Crawler $propertyRow) use (&$properties, $product) {
                $propertyName = trim($propertyRow->filter('td:first-child')->text());
                
                $property = \App\Models\ProductProperty::where('name', $propertyName)->first();
                
                if (!$property) {
                    $property = new \App\Models\ProductProperty([
                        'name' => $propertyName
                    ]);
                }
                $property->save();

                $property_id = $property->id;
                
                $property = \App\Models\ProductToProductProperty::where('product_property_id', $property_id)->where('product_id', $product->id)->first();
                if (!$property) {
                    $properties[] = new \App\Models\ProductToProductProperty([
                        'product_property_id' => $property_id,
                        'value' => trim($propertyRow->filter('td:last-child')->text()),
                    ]);
                }
            });
        } return $properties;
    }

}
