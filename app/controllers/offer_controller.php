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
}