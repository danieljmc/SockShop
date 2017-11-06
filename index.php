<?php
require 'vendor/autoload.php';

$container = new \Slim\Container;
$app = new \Slim\App($container);
$container['view'] = new \Slim\Views\PhpRenderer("./html");

// Root directory (ie home)
$app->get('/', function ($request, $response, $args) {
    $response = $this->view->render($response, "home.html");
    return $response;
});

$app->run();