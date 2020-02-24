<?php
namespace Config;
use \Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

// this is the extension help to build twig custom features
class Filter extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new \Twig\TwigFunction('render_static', [$this, 'render_static']),
            new \Twig\TwigFunction('render_route', [$this, 'route']),
            new TwigFunction("full_path",[$this,"full_path"]),
        ];
    }

    public function render_static($path){
        return '/static/'.$path;
    }

    public function route($path){
        return 'public/'.$path;
    }

    public function url(){
        return sprintf(
            "%s://%s%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            $_SERVER['REQUEST_URI']
        );
    }

    public function full_path(){
        return $_SERVER['REQUEST_URI'];
    }

}
