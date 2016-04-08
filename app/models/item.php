<?php

class Item extends BaseModel {

    public $id, $owner_id, $name, $description, $status, $added;

    public function __construct($attributes) {
        parent::__construct($attributes);
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

}
