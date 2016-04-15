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
        $attributes = array(
            'name' => $params['name'],
            'description' => $params['description'],
        );

        $item = new Item($attributes);
        $errors = $item->errors();

        if (count($errors) == 0) {
            $item->save();
            Redirect::to('/items/' . $item->id, array('message' => 'Uusi kohde lisätty!'));
        } else {
            View::make('items/add_item.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

}
