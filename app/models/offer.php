<?php

class Offer extends BaseModel {
    public $id, $sender_id, $reciever_id, $item_id, $description, $offer_type, $sent;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function find_sent_offers($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tarjous INNER JOIN Kayttaja ON Tarjous.reciever_id=Kayttaja.id INNER JOIN Kohde ON Tarjous.item_id=Kohde.id WHERE Tajous.sender_id=id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $offer = new Offer(array(
                'id' => $row['id'],
                'sender_id' => $row['sender_id'],
                'reciever_id' => $row['reciever_id'],
                'item_id' => $row['item_id'],
                'description' => $row['description'],
                'offer_type' => $row['offer_type'],
                'sent' => $row['sent']
            ));
            return $offer;
        }
        return null;
    }
}

