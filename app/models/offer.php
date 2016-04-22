<?php

class Offer extends BaseModel {
    public $id, $sender_id, $reciever_id, $item_id, $description, $offer_type, $sent;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
}

