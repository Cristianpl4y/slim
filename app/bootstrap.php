<?php 
//Iniciando a sessão
session_start();
//setando data e hora.
date_default_timezone_set('America/Sao_Paulo');
//Importando arquivo de autoload
require __DIR__ . '/../vendor/autoload.php';
//Instanciando a Aplicação slim
$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

/**
 * O Slim trabalha com Conteiners esses conteiners, armazenam valores.
 * podemos dizer que esses conteiners são como arrays.
 */

$container = $app->getContainer(); // Aqui crio o Array.

//aqui crio o conteiner passando o ola como chave que retorna a string.
$container['Ola'] = "Olá, mundo :)";

//aqui eu passo a chave e o valor que é a função e essa mesma função retorna uma instacia da classe controller.
$container['HomeController'] = function($container){
    // retornando a Instacia do meu Controller.
    return new App\Controllers\HomeController($container);
};

//Importando o arquivo de rotas
require __DIR__ . '/routes.php';

