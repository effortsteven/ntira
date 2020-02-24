<?php


namespace System\views;
use Config\GlobalView;
use Config\View;
use Controllers\InnerProduct;
use Controllers\WebProduct;

class NonLifeProductView extends GlobalView
{
    public function get($request,$response){
        $products = WebProduct::get_life_web_product(2);
        $inner_products = InnerProduct::all();
        return View::render("non_life_products.html.twig",["products"=>$products,"inner_products"=>$inner_products]);
    }
}