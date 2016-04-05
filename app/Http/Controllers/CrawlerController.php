<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CrawlerController extends Controller {

    public function __construct() {
        header('Content-Type: text/html; charset=utf-8');
        set_time_limit(36000);
    }
    
    public function collectCategories() {
        $c = new \App\Libs\CategoriesCrawler();
        $c->execute();
    }
    
    public function collectProducts() {
        $p = new \App\Libs\ProductsCrawler();
        $p->execute();
    }
    
    public function updateProducts() {
        $up = new \App\Libs\UpdateProductsCrawler();
        $up->execute();
    }
    
    public function updatePictures(){
        $pu = new \App\Libs\UpdatePicturesCrawler();
        $pu->execute();
        
    }
}
