<?php

namespace App\Controllers;

use App\Controllers\Controller;

use App\Models\User;
use App\Models\UserPermission;
use DateTime;

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

        // ajustando data
        $now = new \DateTime();
        $now->modify('+1 hour');
        $key = bin2hex(random_bytes(20));

       $user = User::create([
            'name' => $request->getParam('name'),
            'email' => $request->getParam('email'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
            'confirmation_key' => $key,
            'confirmation_expires' => $now,
        ]);

        $user->permissions()->create(UserPermission::$defaults);

        return $response->withRedirect($this->container->router->pathFor('auth.login'));
    }
}