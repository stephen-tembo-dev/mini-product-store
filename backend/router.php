<?php

// Create Router instance
$router = new \Bramus\Router\Router();

// Define routes
$router->setNamespace('\app\controllers');
$router->get('api/products', 'ProductController@getProducts');
$router->get('api/products/{id}', 'ProductController@getProduct');
$router->post('api/add-product', 'ProductController@addProduct');
$router->post('api/delete-products', 'ProductController@deleteProducts');


$router->run();