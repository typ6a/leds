<?php

namespace App\Libs;

use Symfony\Component\DomCrawler\Crawler as Crawler;

class UpdatePicturesCrawler {

    protected $base_url = 'http://newhtf.ru';

    //protected $base_url = null;

    public function execute() {
        // $products = \App\Models\ProductImage::whereNotIn('product_id', [])->get();

        $products = \App\Models\Product::
            query()->leftJoin('product_image as pi', 'pi.product_id', '=', 'product.id')->whereNull('pi.id')->groupBy('product.id')->get([
            'product.*'
        ]);

        foreach ($products as $product) {

            
                     
            $response = @file_get_contents($product->url);
            //pre($http_response_header,1);
            $response_code = (int) explode(' ', $http_response_header[0])[1];
            if (trim($response) || ($response_code > 400 && $response_code < 500)) {
                $product->delete();
                continue;
            }

            $url = $product->url;


            //$url = 'http://newhtf.ru/catalog/ofisnoe-ulichnoe-promyshlennoe/ofisnye_svetodiodnye_svetilniki_1200kh180_s_prizmaticheskim_steklom/svetodiodnyy_svetilnik_potolochnyy_s_prizmaticheskim_steklom_1200_180_40_24w_220v_ip40_ep_cw.html';
            $html = file_get_contents($url);

            $this->crawler = new Crawler($html);


            $product->images()->saveMany($this->updatePictures($product));

            $product->processed = 1;
            $product->save();
            //exit('sdfdsf');
            sleep(1);
        }
        pre('dine done', 1);
    }

    protected function updatePictures($product) {
        $images = [];
        $items = $this->crawler->filter('.stick_img > img');

        if ($items->count()) {
            $items->each(function (Crawler $image, $i) use (&$images, $product) {

                $url = str_replace('resizer2/7', 'resizer2/2', $image->attr('src'));
                $parts = explode('?', $url);
                $url = (string) array_shift($parts);
                $imageUrl = 'http://' . trim($url, '/');
                $filename = $product->category_id . '.' . 'upd' . $i . '.jpg';
                $images[] = new \App\Models\ProductImage([
                    'url' => $imageUrl,
                    'filename' => $filename
                ]);
                // save image to local HDD                    
                $filepath = 'd:\workspace\products\public\data\images\\' . $filename;

                file_put_contents($filepath, file_get_contents($imageUrl));
                //pre($images);
            });
        } return $images;
    }

}
