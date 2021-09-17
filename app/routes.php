<?php
/**
 *  Entendendo as rotas
 *  Primeiro parametro '/' eu indico o caminho para que o usuario possa acessar.
 *  O Segundo paramentro 'HomeController' eu indico que quando o '/' for acessado eu quero que chame esse controller
 *  e ai dentro desse controller eu quero que chame o metodo 'index'.
 *  setName eu dou o nome da rota, para minha função path_for() funcionar.
 */
$app->get('/', 'HomeController:index')->setName('home');

// Criando grupo para rotas especificas.
// antes sem o grupo a url iria ser assim: http://localhost:8000/login 
// e agora com o grupo '/auth' fica asssim: http://localhost:8000/auth/login
$app->group('/auth', function($app){
    //Criando rotas de autenticação 
    // Modificando get p/ map para mapear o numero de rotas e passando um array dizendo que essa rota vai aceitar 
    // GET E POST
    $app->map(['GET', 'POST'],'/login', 'AuthController:login')->setName('auth.login');
    $app->map(['GET', 'POST'],'/registrar', 'AuthController:register')->setName('auth.register');
});
