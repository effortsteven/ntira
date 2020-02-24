<?php


namespace System\views;
use Config\Form;
use Config\GlobalView;
use Config\View;
use Controllers\NewsFeed;

class ReadMoreView extends GlobalView
{
    public function get($request,$response){
        $news = NewsFeed::get_one_news_feeds($request->id);
        $form = Form::createForm(['Email'=>'email']);
        return View::render("readmore.html.twig",["news"=>$news,"form"=>$form]);
    }
}