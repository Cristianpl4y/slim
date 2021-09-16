<?php

namespace App\Controllers;

Class HomeController
{
   // Aqui eu crio a propriedade.
    private $container;
   // Criando metodo construtor recebendo como parametro o $container 
   public function __construct($container)
   {
       // e aqui eu digo que a minha propriedade conteiner recebe o meu conteiner que vem via parametro.
       $this->container = $container;
   }
   
    public function index($request, $response)
    {
        /** Forçando erro Aula 10.
         * Notice: Undefined property: App\Controllers\HomeController::$container in C:\xampp\htdocs\slim\app\Controllers\HomeController.php on line 13
         * Notice: Trying to get property 'Ola' of non-object in C:\xampp\htdocs\slim\app\Controllers\HomeController.php on line 13
         * esse erro acontece quando não temos o metodo construtor 
         */
        return $response->write($this->container->Ola);
    }
}