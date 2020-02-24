<?php


namespace System\views;
use Config\GlobalView;
use Config\View;
use Controllers\Testimon;


class TestimonView extends GlobalView
{
    public function get($request,$response){
        $testimons = Testimon::get_all_testimon();
        return View::render("testimon.html.twig",["testimons"=>$testimons]);
    }
}