<?php

class Item extends BaseModel {

    public $id, $owner_id, $name, $description, $status, $added;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_description');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Kohde');
        $query->execute();
        $rows = $query->fetchAll();
        $items = array();
        foreach ($rows as $row) {
            $items[] = new Item(array(
                'id' => $row['id'],
                'owner_id' => $row['owner_id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'status' => $row['status'],
                'added' => $row['added']
            ));
        }
        return $items;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kohde WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $item = new Item(array(
                'id' => $row['id'],
                'owner_id' => $row['owner_id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'status' => $row['status'],
                'added' => $row['added']
            ));
            return $item;
        }
        return null;
    }

    public function save() {
        // Toteuta vielä omistajan lisäys

        $query = DB::connection()->prepare('INSERT INTO Kohde (name, description, added ) VALUES (:name, :description, NOW()) RETURNING id');
        $query->execute(array('name' => $this->name, 'description' => $this->description));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public static function edit($id) {
        $item = Item::find($id);
        View::make('items/edit_item.html', array('attributes' => $item));
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $row['id'],
            'owner_id' => $row['owner_id'],
            'name' => $row['name'],
            'description' => $row['description'],
            'status' => $row['status'],
            'added' => $row['added']
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
        $item = new Item(array('id' => $id));
        $item->destroy();

        Redirect::to('/own_items', array('message' => 'Kohde on poistettu onnistuneesti!'));
    }

    public function validate_name() {
        $errors = array();
        if ($this->name == '' || $this->name == null) {
            $errors[] = 'Nimi ei voi olla tyhjä!';
        }
        if (strlen($this->name) < 3) {
            $errors[] = 'Nimen tulee olla vähintään kolme merkkiä!';
        }

        return $errors;
    }

    public function validate_description() {
        $errors = array();
        if ($this->description == '' || $this->description == null) {
            $errors[] = 'Kuvaus ei voi olla tyhjä!';
        }
        if (strlen($this->description) < 10) {
            $errors[] = 'Kuvauksen tulee olla vähintään kymmenen merkkiä!';
        }

        return $errors;
    }

}
