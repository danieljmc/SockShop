<?php
require 'vendor/autoload.php';

$container = new \Slim\Container;
$app = new \Slim\App($container);
$container['view'] = new \Slim\Views\PhpRenderer("./html");

// Root directory (ie home)
$app->get($req->getRootUri() . '/', function($request, $response, $args) {
    $response = $this->view->render($response, "home.html");
    return $response;
});

$app->get('/search[{q}]', function ($request, $response, $args) use ($app) {
    return $_GET['q'];
});

$app->get( '/about', function($request, $response, $args) {
    $response = $this->view->render($response, "about.html");
    return $response;
});

$app->get('/contact', function($request, $response, $args) {
    $response = $this->view->render($response, "contact.html");
    return $response;
});

$app->get('/stores/', function($request, $response, $args) {
    $response = $this->view->render($response, "locator.html");
    return $response;
});

$app->get('/myaccount', function($request, $response, $args) {
    $response = $this->view->render($response, "login.html");
    return $response;
});

$app->run();