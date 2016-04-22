<?php

class Offer extends BaseModel {
    public $id, $sender_id, $sender_name, $reciever_id, $reciever_name, $item_id, $item_name, $message, $offer_type, $sent;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function allRecieved($user_id) {
        $query = DB::connection()->prepare('SELECT * FROM Tarjous INNER JOIN Kayttaja ON Tarjous.sender_id = Kayttaja.id INNER JOIN Kohde ON Tarjous.item_id = Kohde.id WHERE Tarjous.reciever_id = :user_id');
        $query->execute(array('user_id' => $user_id));
        $rows = $query->fetchAll();
        $offers = array();
        foreach ($rows as $row) {
            $offers[] = new Offer(array(
                'id' => $row['id'],
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
        $query = DB::connection()->prepare('SELECT * FROM Tarjous INNER JOIN Kayttaja ON Tarjous.reciever_id = Kayttaja.id INNER JOIN Kohde ON Tarjous.item_id = Kohde.id WHERE Tarjous.sender_id = :user_id');
        $query->execute(array('user_id' => $user_id));
        $rows = $query->fetchAll();
        $offers = array();
        foreach ($rows as $row) {
            $offers[] = new Offer(array(
                'id' => $row['id'],
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
        $query = DB::connection()->prepare('SELECT * FROM Tarjous INNER JOIN Kohde ON Tarjous.item_id = Kohde.id WHERE Tarjous.id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $offer = new Offer(array(
                'id' => $row['id'],
                'reciever_id' => $row['reciever_id'],
                'sender_id' => $row['sender_id'],
                'item_id' => $row['item_id'],
                'item_name' => $row['name'],
                'message' => $row['message'],
                'offer_type' => $row['offer_type'],
                'sent' => $row['sent']
            ));
            return $offer;
        }
        return null;
    }

}

