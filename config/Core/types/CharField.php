<?php

namespace Config;
trait CharField{

    public $max_length;

    public function __construct($max_length)
    {
        $this->max_length = $max_length;
    }

    /**
     * @return mixed
     */
    public function getMaxLength()
    {
        return $this->max_length;
    }
}