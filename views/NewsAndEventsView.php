<?php


namespace System\views;

use Config\Form;
use Config\GlobalView;
use Config\View;
use Controllers\CustomerEmail;
use Controllers\NewsFeed;


class NewsAndEventsView extends GlobalView
{
    public function get($request, $response, $service)
    {
        $news_feeds = NewsFeed::all_news_feeds();
        $form = Form::createForm(['Email' => 'email']);
        return View::render("news_and_events.html.twig", ["news_feeds" => $news_feeds, "form" => $form]);
    }

    public function post($request, $response)
    {
        if (isset($_POST['email'])) {
            try {
                CustomerEmail::create_email($_POST['email']);
                $email = CustomerEmail::get_one_email(($_POST['email']))[0]['email'];
                $client = curl_init();
                $url = 'http://192.168.43.86:8001/emailApi/';
                curl_setopt($client, CURLOPT_URL, $url);
                curl_setopt($client, CURLOPT_POST, 1);
                curl_setopt($client, CURLOPT_POSTFIELDS, "email={$email}");
                $response = curl_exec($client);
                print ($response);

                if (isset($_POST['news_id'])) {
                    $news = NewsFeed::get_one_news_feeds($_POST['news_id']);
                }
                $info = [
                    "status" => true,
                    "message" => "Successfully Subscribed"
                ];
            } catch (\Exception $e) {
                error_log($e->getMessage(), 4);
                $info = [
                    "status" => false,
                    "message" => "Failed to Subscribed"
                ];
            }
        } else {
            $info = [
                "status" => false,
                "message" => "Failed to Subscribed"
            ];
        }
//        error_log(print_r($info,true));
        $send = $request->param("param", "json");
        $response->$send($info);
    }
}