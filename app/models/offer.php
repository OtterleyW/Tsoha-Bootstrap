<?php

class Offer extends BaseModel {
    public $id, $sender_id, $sender_name, $reciever_id, $item_id, $description, $offer_type, $sent;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function allRecieved($user_id) {
        $query = DB::connection()->prepare('SELECT * FROM Tarjous INNER JOIN Kayttaja ON Tarjous.sender_id = Kayttaja.id WHERE Tarjous.reciever_id = :user_id');
        $query->execute(array('user_id' => $user_id));
        $rows = $query->fetchAll();
        $offers = array();
        foreach ($rows as $row) {
            $offers[] = new Offer(array(
                'id' => $row['id'],
                'sender_id' => $row['sender_id'],
                'sender_name' => $row['username'],
                'item_id' => $row['item_id'],
                'description' => $row['description'],
                'offer_type' => $row['offer_type'],
                'sent' => $row['sent']
            ));
        }
        
        return $offers;
    }
}

