<?php 

namespace App\Controllers;

class Controller
{
   // Aqui eu crio a propriedade.
   protected $container;
   // Criando metodo construtor recebendo como parametro o $container 
   public function __construct($container)
   {
       // e aqui eu digo que a minha propriedade conteiner recebe o meu conteiner que vem via parametro.
       $this->container = $container;
   }
}