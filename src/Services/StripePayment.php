<?php

namespace App\Services;

use Stripe\Stripe;

class StripePayment{

    public $redirectUrl; 
    public function __construct(){
        Stripe::setApiKey($_SERVER('STRIPE_SECRET_KEY'));
        Stripe::setApiVersion('2026-02-25.clover');
    }
    public function startPayment($cart) {
        dd($cart);;
    }
}    


