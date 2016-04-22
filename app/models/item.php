<?php

class Item extends BaseModel {

    public $id, $owner_id, $owner_name, $name, $description, $offer_wanted, $status, $added;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_description');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Kohde INNER JOIN Kayttaja ON Kohde.owner_id = Kayttaja.id');
        $query->execute();
        $rows = $query->fetchAll();
        $items = array();
        foreach ($rows as $row) {
            $items[] = new Item(array(
                'id' => $row['id'],
                'owner_id' => $row['owner_id'],
                'owner_name' => $row['username'],
                'name' => $row['name'],
                'description' => $row['description'],
                'offer_wanted' => $row['offer_wanted'],
                'status' => $row['status'],
                'added' => $row['added']
            ));
        }
        
        return $items;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kohde, Kayttaja WHERE Kohde.id = :id AND Kohde.owner_id = Kayttaja.id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $item = new Item(array(
                'id' => $row['id'],
                'owner_id' => $row['owner_id'],
                'owner_name' => $row['username'],
                'name' => $row['name'],
                'description' => $row['description'],
                'offer_wanted' => $row['offer_wanted'],
                'status' => $row['status'],
                'added' => $row['added']
            ));
            return $item;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Kohde (name, description, added, owner_id ) VALUES (:name, :description, NOW(), :owner_id) RETURNING id');
        $query->execute(array('name' => $this->name, 'description' => $this->description, 'owner_id' => $this->owner_id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Kohde SET name=:name, description= :description WHERE id= :id RETURNING id');
        $query->execute(array('id' => $this->id, 'name' => $this->name, 'description' => $this->description));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Kohde WHERE id=:id');
        $query->execute(array('id' => $this->id));
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

    private function find_owner($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaha WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $item = new Item(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email']
            ));
            return $item;
        }
        return null;
    }

}
