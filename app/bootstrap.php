<?php 
//Iniciando a sessão
session_start();
//setando data e hora.
date_default_timezone_set('America/Sao_Paulo');
//Importando arquivo de autoload
require __DIR__ . '/../vendor/autoload.php';
//Instanciando a Aplicação slim
$app = new Slim\App();

$container = $app->getContainer();


$container['HomeController'] = function($container){
    return new App\Controllers\HomeController;
};

//Importando o arquivo de rotas
require __DIR__ . '/routes.php';

