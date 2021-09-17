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
        'displayErrorDetails' => true,
    ]
]);

/**
 * O Slim trabalha com Conteiners esses conteiners, armazenam valores.
 * podemos dizer que esses conteiners são como arrays.
 */

$container = $app->getContainer(); // Aqui crio o Array.

//Fazendo conexão com o meu banco.
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection([
    'driver'    => 'mysql', // é banco de dados que estou trabalhando
    'host'      => 'localhost', // Onde o banco de dados esta hospedado
    'database'  => 'mpblog', // base de dados
    'username'  => 'root', // nome do usuario que tem acesso ao banco de dados
    'password'  => 'root', // senha de acesso do usuario.
    'charset'   => 'utf8', // passando que quero trabalhar com UTF8
    'collation' => 'utf8_unicode_ci', // Minha base de dados tbm vai trabalhar com utf8
    'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['validator'] = function($container){
    return new App\Validation\Validator;
};

//configurando o Twig template
$container['view'] = function($container){
    $view = new Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => false,
    ]);

    $view->addExtension(new Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};

//aqui crio o conteiner passando o ola como chave que retorna a string.
$container['Ola'] = "Olá, mundo :)";

//aqui eu passo a chave e o valor que é a função e essa mesma função retorna uma instacia da classe controller.
$container['HomeController'] = function($container){
    // retornando a Instacia do meu Controller.
    return new App\Controllers\HomeController($container);
};

// criando cointainer para autenticação
$container['AuthController'] = function($container){
    // retornando a Instacia do meu Controller.
    return new App\Controllers\AuthController($container);
};

// Adicionando Middleware porem esta com erro !!!! tem que ver oq é !!!!
$app->add(new App\Middleware\DisplayInputErrorsMiddleware($container));

//Importando o arquivo de rotas
require __DIR__ . '/routes.php';

