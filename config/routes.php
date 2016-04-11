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
    ItemController::index();
});

$routes->get('items/item_list', function() {
    ItemController::index();
});

$routes->post('/items', function() {
    ItemController::store();
});

$routes->get('/add_item', function() {
    ItemController::add_item();
});

$routes->get('/items/:id', function($id) {
    ItemController::show($id);
});

$routes->get('/own_items', function() {
    HelloWorldController::own_items();
});

$routes->get('/edit_item', function() {
    HelloWorldController::edit_item();
});

$routes->get('/send_offer', function() {
    HelloWorldController::send_offer();
});


