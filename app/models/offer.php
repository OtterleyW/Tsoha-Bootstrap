<?php

class Offer extends BaseModel {

    public $id, $sender_id, $sender_name, $reciever_id, $reciever_name, $item_id, $item_name, $owner_name, $message, $offer_type, $sent;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_message');
    }

    public static function allRecieved($user_id) {
        $query = DB::connection()->prepare('SELECT Tarjous.id AS tarjousid, Tarjous.sender_id, Tarjous.item_id, Tarjous.message, Tarjous.offer_type, Tarjous.sent, Kayttaja.id as kayttajaid, Kayttaja.username, Kohde.id as kohdeid, Kohde.name FROM Tarjous, Kayttaja, Kohde WHERE  Tarjous.sender_id = Kayttaja.id AND Tarjous.item_id = Kohde.id AND Tarjous.reciever_id = :user_id');
        $query->execute(array('user_id' => $user_id));
        $rows = $query->fetchAll();
        $offers = array();
        foreach ($rows as $row) {
            $offers[] = new Offer(array(
                'id' => $row['tarjousid'],
                'sender_id' => $row['sender_id'],
                'sender_name' => $row['username'],
                'item_id' => $row['item_id'],
                'item_name' => $row['name'],
                'message' => $row['message'],
                'offer_type' => $row['offer_type'],
                'sent' => $row['sent']
            ));
        }

        return $offers;
    }

    public static function allSent($user_id) {
        $query = DB::connection()->prepare('SELECT Tarjous.id AS tarjousid, Tarjous.reciever_id, Tarjous.item_id, Tarjous.message, Tarjous.offer_type, Tarjous.sent, Kayttaja.id as kayttajaid, Kayttaja.username, Kohde.id as kohdeid, Kohde.name FROM Tarjous, Kayttaja, Kohde WHERE Tarjous.reciever_id = Kayttaja.id AND Tarjous.item_id = Kohde.id AND Tarjous.sender_id = :user_id');
        $query->execute(array('user_id' => $user_id));
        $rows = $query->fetchAll();
        $offers = array();
       kint::dump($rows); 
        foreach ($rows as $row) {
            $offers[] = new Offer(array(
                'id' => $row['tarjousid'],
                'reciever_id' => $row['reciever_id'],
                'reciever_name' => $row['username'],
                'item_id' => $row['item_id'],
                'item_name' => $row['name'],
                'message' => $row['message'],
                'offer_type' => $row['offer_type'],
                'sent' => $row['sent']
            ));
        }
        
        return $offers;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT Tarjous.id AS tarjousid, Tarjous.reciever_id, Tarjous.sender_id, Tarjous.item_id, Tarjous.message, Tarjous.offer_type, Tarjous.sent, Kayttaja.id as kayttajaid, Kayttaja.username, Kohde.id as kohdeid, Kohde.name FROM Tarjous, Kayttaja, Kohde WHERE Tarjous.reciever_id = Kayttaja.id AND Tarjous.item_id = Kohde.id AND Tarjous.id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        kint::dump($row);
        if ($row) {
            $offer = new Offer(array(
                'id' => $row['tarjousid'],
                'reciever_id' => $row['reciever_id'],
                'sender_id' => $row['sender_id'],
                'item_id' => $row['item_id'],
                'item_name' => $row['name'],
                'owner_name' => $row['username'],
                'message' => $row['message'],
                'offer_type' => $row['offer_type'],
                'sent' => $row['sent']
            ));
            return $offer;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tarjous (sender_id, reciever_id, item_id, message, offer_type, sent ) VALUES (:sender_id, :reciever_id, :item_id, :message, :offer_type, NOW()) RETURNING id');
        $query->execute(array('sender_id' => $this->sender_id, 'reciever_id' => $_SESSION['item_owner'], 'item_id' => $_SESSION['item_id'], 'message' => $this->message, 'offer_type' => $this->offer_type));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    // Toteutettava vielä muokkaus ja poisto
    
    public function validate_message() {
        $errors = array();
        if ($this->message == '' || $this->message == null) {
            $errors[] = 'Viesti ei voi olla tyhjä!';
        }
        if (strlen($this->message) < 10) {
            $errors[] = 'Viestin tulee olla vähintään kymmenen merkkiä!';
        }
        return $errors;
    }

}
