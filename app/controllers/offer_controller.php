<?php

class OfferController extends BaseController {


    public static function show($id) {
        $item = Item::find($id);
        View::make('offers/offer.html', array('offer' => $offer));
    }
}