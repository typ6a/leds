<?php

namespace App\Libs;

use Symfony\Component\DomCrawler\Crawler as Crawler;

class ProductsCrawler {
    protected $base_url = 'http://newhtf.ru';

    //protected $base_url = null;

    public function execute() {
        //$category = new \stdClass();
        //$category->id = 105;
        //$category->url = 'http://newhtf.ru/catalog/ofisnoe-ulichnoe-promyshlennoe/svetodiodnye_svetilniki_armstrong_dlya_pomeshcheniy_s_vysokimi_potolkami/';
        $categories = \App\Models\ProductCategory::where('processed', 0)->get();
        //$categories = [$category];
        foreach ($categories as $category) {
            $this->crawlProductsPage($category);
        }
        //pre($category, 1);
    }

    /**
     * 
     * @param \App\Models\ProductCategory $category
     */
    protected function crawlProductsPage(\App\Models\ProductCategory $category) {
        $url = $category->url;
        //$url = 'http://newhtf.ru/catalog/ofisnoe-ulichnoe-promyshlennoe/ofisnye_svetodiodnye_svetilniki_1200kh180_s_prizmaticheskim_steklom/';
        $html = file_get_contents($url);
        //pre($html, 1);
        $crawler = new Crawler($html);
        $items = $crawler->filter('.catalog-list li .item-popup > .sl_img');
        //pre($items->count(),1);
        if ($items->count()) {
            
            $items->each(function (Crawler $linkProductNode) use ($category) {
                
                if ($linkProductNode->filter('img')->count() > 0) {
                    $url = $this->base_url . '/' . ltrim($linkProductNode->attr('href'), '/');
                    $title = $linkProductNode->filter('img')->attr('alt');
                    
                    $productObject = \App\Models\Product::where('category_id', $category->id)->where('url', $url)->first();
                    
                    if(!$productObject){
                        $productObject = new \App\Models\Product([
                            'category_id' => $category->id,
                            'title' => $title,
                            'url' => $url
                        ]);
                    }
                    
                    //pre($productObject, 1);
                    $productObject->save();
                }
                sleep(1);
            });
        }
        $category->processed = 1;
        $category->save();
    }
        

}
