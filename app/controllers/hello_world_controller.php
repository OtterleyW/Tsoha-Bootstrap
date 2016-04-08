<?php

require 'app/models/item.php';

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
    }

    public static function sandbox() {
        $item = Item::find(1);
        $items = Item::all();
        // Kint-luokan dump-metodi tulostaa muuttujan arvon
        Kint::dump($items);
        Kint::dump($item);
    }

    public static function login() {
        View::make('suunnitelmat/login.html');
    }

    public static function item_list() {
        View::make('suunnitelmat/item_list.html');
    }

    public static function item() {
        View::make('suunnitelmat/item.html');
    }

    public static function edit_item() {
        View::make('suunnitelmat/edit_item.html');
    }

    public static function own_items() {
        View::make('suunnitelmat/own_items.html');
    }

    public static function send_offer() {
        View::make('suunnitelmat/send_offer.html');
    }

}
