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

    public static function get_offers_by_item_id($item) {
        self::check_logged_in();
        $item_id = $item->id;
        $offers = Offer::byItemId($item_id);

        return $offers;
    }

    public static function send_offer() {
        self::check_logged_in();
        View::make('offers/send_offer.html');
    }

    public static function edit_offer($id) {
        self::check_logged_in();
        $offer = Offer::find($id);
        View::make('offers/edit_offer.html', array('attributes' => $offer));
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

    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'message' => $params ['message'],
        );

        $offer = new Offer($attributes);
        $errors = $offer->errors();

        if (count($errors) > 0) {
            View::make('offers/edit_item.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $offer->update();

            Redirect::to('/offers/' . $offer->id, array('message' => 'Tarjousta on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $offer = new Offer(array('id' => $id));
        $offer->destroy();

        Redirect::to('/own_offers', array('message' => 'Tarjous on poistettu onnistuneesti!'));
    }

    public static function destroyNoRedirect($id) {
        self::check_logged_in();
        $offer = new Offer(array('id' => $id));
        $offer->destroy();
    }

    public static function accept($id) {
        self::check_logged_in();
        $offer = new Offer(array('id' => $id, 'offer_type' => 'hyväksytty'));
        $offer->changeType();
        $offer = $offer->find($id);
        $status = "varattu";

        ItemController::changeStatus($offer->item_id, $status);

        $offers = $offer->byItemId($offer->item_id);

        foreach ($offers as $offer) {
            if ($offer->id != $id) {
                OfferController::declineNoRedirect($offer->id);
            }
        }

        Redirect::to('/offers/' . $offer->id, array('message' => 'Tarjous hyväksytty!'));
    }

    public static function decline($id) {
        self::check_logged_in();
        $offer = new Offer(array('id' => $id, 'offer_type' => 'hylätty'));
        $offer->changeType();
        $offer = $offer->find($id);

        Redirect::to('/offers/' . $offer->id, array('message' => 'Tarjous hylätty!'));
    }
    
    public static function declineNoRedirect($id) {
        self::check_logged_in();
        $offer = new Offer(array('id' => $id, 'offer_type' => 'hylätty'));
        $offer->changeType();
        $offer = $offer->find($id);
    }

}
