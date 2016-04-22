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
        self::check_logged_in();
        View::make('items/add_item.html');
    }

    public static function own_items() {
        self::check_logged_in();
        $items = Item::all();
        View::make('items/own_items.html', array('items' => $items));
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'name' => $params['name'],
            'description' => $params['description'],
            'owner_id' => $params ['owner_id']
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

    public static function edit($id) {
        self::check_logged_in();
        $item = Item::find($id);
        View::make('items/edit_item.html', array('attributes' => $item));
    }

    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'description' => $params['description']
        );

        $item = new Item($attributes);
        $errors = $item->errors();

        if (count($errors) > 0) {
            View::make('items/edit_item.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $item->update();

            Redirect::to('/items/' . $item->id, array('message' => 'Kohdetta on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $item = new Item(array('id' => $id));
        $item->destroy();

        Redirect::to('/own_items', array('message' => 'Kohde on poistettu onnistuneesti!'));
    }
}