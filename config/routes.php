<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/login', function() {
  HelloWorldController::login();
  });
  
  $routes->get('/item_list', function() {
    HelloWorldController::item_list();
  });
  
  $routes->get('/item', function() {
    HelloWorldController::item();
});

$routes->get('/own_items', function() {
    HelloWorldController::own_items();
});
