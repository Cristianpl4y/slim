<?php

namespace App\Controllers;

use App\Controllers\Controller;

Class HomeController extends Controller
{
    public function index($request, $response)
    {
        return $response->write($this->container->Ola);
    }
}