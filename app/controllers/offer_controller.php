<?php

class OfferController extends BaseController {

    public static function show($id) {
        $offer = Offer::find($id);
        View::make('offers/offer.html', array('offer' => $offer));
    }

    public static function own_offers() {
        self::check_logged_in();
        $user = self::get_user_logged_in();
        $user_id = $user->id;
        $recieved_offers = Offer::allRecieved($user_id);
        $sent_offers = Offer::allSent($user_id);
        View::make('offers/own_offers.html', array('recieved_offers' => $recieved_offers, 'sent_offers' => $sent_offers));
    }

    public static function send_offer() {
        self::check_logged_in();
        View::make('offers/send_offer.html');
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'sender_id' => $params['sender_id'],
            'message' => $params ['message'],
            'offer_type' => $params ['offer_type']
        );

        $item = new Offer($attributes);
        
        $errors = $item->errors();

        if (count($errors) == 0) {
            $item->save();
            Redirect::to('/offers/' . $item->id, array('message' => 'Tarjous lähetetty!'));
        } else {
            View::make('offers/send_offer.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

}
