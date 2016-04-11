<?php

class ItemController extends BaseController {

    public static function index() {
        $items = Item::all();
        View::make('items/item_list.html', array('items' => $items));
    }

    public static function show($id) {
        $item = Item::find($id);
        View::make('items/item.html', array('item' => $item));
    }
    
    public static function add_item() {
        View::make('items/add_item.html');
    }

    public static function store() {
        $params = $_POST;
        $item = new Item(array(
            'name' => $params['name'],
            'description' => $params['description'],
        ));
        
        Kint::dump($params);
        
        $item->save();
        
        Redirect::to('/items/' . $item->id, array('message' => 'Uusi kohde lisätty!'));

    }
    


}
