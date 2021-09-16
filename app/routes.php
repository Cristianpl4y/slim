<?php
/**
 *  Entendendo as rotas
 *  Primeiro parametro '/' eu indico o caminho para que o usuario possa acessar.
 *  O Segundo paramentro 'HomeController' eu indico que quando o '/' for acessado eu quero que chame esse controller
 *  e ai dentro desse controller eu quero que chame o metodo 'index'.
 */
$app->get('/', 'HomeController:index');