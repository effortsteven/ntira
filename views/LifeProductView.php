<?php


namespace System\views;
use Config\GlobalView;
use Config\View;
use Controllers\InnerProduct;
use Controllers\WebProduct;

class LifeProductView extends GlobalView
{
    public function get($request,$response){
        $products = WebProduct::get_life_web_product(1);
        $inner_products = InnerProduct::all();
        return View::render("life_products.html.twig",["products"=>$products,"inner_products"=>$inner_products]);
    }
}