<?php

namespace App\Middleware;

class  Middleware
{
    protected $contianer;

    public function __construct($contianer)
    {
        $this->contianer = $contianer; // Corrigindo erro $this->$contianer e não $container
    }
}