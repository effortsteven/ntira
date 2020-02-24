<?php


namespace Config\Core\tags;


use Config\Core\Project_Set_Node;

class Project_Set_TokenParser extends \Twig\TokenParser\AbstractTokenParser{
    public function parse(\Twig_Token $token)
    {
        $parser = $this->parser;
        $stream = $parser->getStream();


        $name = $stream->expect(\Twig\Token::NAME_TYPE)->getValue();
        $stream->expect(\Twig\Token::OPERATOR_TYPE, '=');
        $value = $parser->getExpressionParser()->parseExpression();
        $stream->expect(\Twig\Token::BLOCK_END_TYPE);
        return new Project_Set_Node($name, $value, $token->getLine(), $this->getTag());
    }

    public function getTag()
    {
        return 'render_field';
    }

}