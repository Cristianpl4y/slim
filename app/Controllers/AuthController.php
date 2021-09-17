<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\User;

Class AuthController extends Controller
{
    public function login($request, $response)
    {
        if($request->isGet())
        return $this->container->view->render($response, 'login.twig');
    }

    public function register($request, $response)
    {
        if($request->isGet())
        return $this->container->view->render($response, 'register.twig');

        $data = date('d/m/Y');
        $now = implode("-",array_reverse(explode("/",$data)));

        User::create([
            'name' => $request->getParam('name'),
            'email' => $request->getParam('email'),
            'password' => $request->getParam('password'),
            'confirmation_key' => 'aaskfpaskf',
            'confirmation_expires' => $now,
        ]);

        return $response->withRedirect($this->container->router->pathFor('auth.login'));
    }
}