<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      echo 'Hello World!';
    }

    public static function login(){
       View::make('suunnitelmat/login.html');
     }
     
     public static function item_list(){
       View::make('suunnitelmat/item_list.html');
     }
  }
