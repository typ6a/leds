<?php

namespace App\Libs;

use Symfony\Component\DomCrawler\Crawler as Crawler;

class CategoriesCrawler {
    
    protected $base_url = 'http://newhtf.ru';
    
    protected $catalog_url = '/catalog';
    
    public function execute(){
        $this->crawlCats0();
    }
    
    protected function crawlCats0(){
        $html = file_get_contents($this->base_url . $this->catalog_url);
        $crawler = new Crawler($html);
        $items = $crawler->filter('.ye_roobriqa .item .image > a');
        $items->each(function (Crawler $linkCategoryNode) {
            if ($linkCategoryNode->filter('img')->count() > 0) {
                $url = $this->base_url . '/' . ltrim($linkCategoryNode->attr('href'), '/');
                $title = $linkCategoryNode->filter('img')->attr('alt');
                $data = [
                    'title' => $title,
                    'url' => $url,
                ];
                $categoryObject = new \App\Models\ProductCategory($data);
                $categoryObject->save();
                $new_category_id = $categoryObject->id;
                $this->crawlCats1($url, $new_category_id);
            }
        });
        //pre('done',1);
        
    }
    
    protected function crawlCats1($url, $parent_id){
        $html = file_get_contents($url);
        $crawler = new Crawler($html);
        $items = $crawler->filter('.ys_catalog_text_ul > li a');
        if($items->count()){
            $items->each(function (Crawler $linkCategoryNode) use ($parent_id) {
                sleep(1);
                if ($linkCategoryNode->filter('img')->count() > 0) {
                    $url = $this->base_url . '/' . ltrim($linkCategoryNode->attr('href'), '/');
                    $title = $linkCategoryNode->filter('img')->attr('title');
                    $categoryObject = new \App\Models\ProductCategory([
                        'parent_id' => $parent_id,
                        'title' => $title,
                        'url' => $url,
                    ]);
                    $categoryObject->save();
                    $new_category_id = $categoryObject->id;
                    $this->crawlCats1($url, $new_category_id);
                }
            });
        }
    }
    
}