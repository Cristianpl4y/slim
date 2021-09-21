<?php

namespace App\Controllers;

use App\Controllers\Controller;

Class UserController extends Controller
{
    public function avatar($request, $response)
    {
        if($request->isGet()){
            return $this->container->view->render($response, 'avatar.twig');
        }
    }
}