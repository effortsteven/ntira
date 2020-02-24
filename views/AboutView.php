<?php


namespace System\views;
use Config\GlobalView;
use Config\View;

class AboutView extends GlobalView
{
    public function get($request,$response){
        return View::render("about.html.twig");
    }
}