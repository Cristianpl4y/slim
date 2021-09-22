<?php 

namespace App\Controllers;

class PostController extends Controller
{
    public function create($request, $response)
    {
        return $this->container->view->render($response, 'post/create.twig');
    }
   
    public function edit($request, $response)
    {
        return $this->container->view->render($response, 'post/edit.twig');
    }
    
    public function update($request, $response)
    {
        
    }
    
    public function delete($request, $response)
    {
        
    }
}