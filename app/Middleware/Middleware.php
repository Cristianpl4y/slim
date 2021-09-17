<?php

namespace App\Middleware;

class  Middleware
{
    protected $container;

    public function __construct($container)
    {
        $this->$container = $container; // esta com erro aqui não sei porq !! vou descobrir 
    }
}