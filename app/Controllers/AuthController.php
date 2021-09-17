<?php

namespace App\Controllers;

use App\Controllers\Controller;

Class AuthController extends Controller
{
    public function login($request, $response)
    {
        return $this->container->view->render($response, 'login.twig');
    }

    public function register($request, $response)
    {
        return $this->container->view->render($response, 'register.twig');
    }
}