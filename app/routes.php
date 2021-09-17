<?php
/**
 *  Entendendo as rotas
 *  Primeiro parametro '/' eu indico o caminho para que o usuario possa acessar.
 *  O Segundo paramentro 'HomeController' eu indico que quando o '/' for acessado eu quero que chame esse controller
 *  e ai dentro desse controller eu quero que chame o metodo 'index'.
 *  setName eu dou o nome da rota, para minha função path_for() funcionar.
 */
$app->get('/', 'HomeController:index')->setName('home');

//Criando rota de autenticação 
$app->get('/login', '')->setName('auth.login');
$app->get('/registrar', '')->setName('auth.register');