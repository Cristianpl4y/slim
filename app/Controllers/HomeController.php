<?php

namespace App\Controllers;

Class HomeController
{
    public function index($request, $response)
    {
        return $response->write(
            'Qual seu nome? <br> meu nome é ' . $request->getParam('nome')
        );
    }
}