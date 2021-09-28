<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Post;

Class HomeController extends Controller
{
    public function index($request, $response)
    {
        $data = [
            'posts' => Post::all()
        ];
        
        return $this->container->view->render($response, 'index.twig', $data);
    }
}