<?php


namespace Config\Core\tags;
use Config\Core\tags\Project_Set_TokenParser;

class Project_Twig_Extension extends \Twig\Extension\AbstractExtension
{
    public function getTokenParsers()
    {
        return [new Project_Set_TokenParser()];
    }

}