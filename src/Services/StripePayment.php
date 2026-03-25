<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripePayment{

    private $redirectUrl; 

    public function __construct(){
        Stripe::setApiKey($_SERVER['STRIPE_SECRET_KEY']);
        Stripe::setApiVersion('2026-02-25.clover');
    }

    public function startPayment($cart, $shippingCost) {

    $cartProducts =$cart['cart'];
    $products =[
        [
            'qte' =>1,
            'price' => $shippingCost,
            'name' => "Frais de livraison"
        ]
    ];
    foreach ($cartProducts as $value){
        $productItem = [];
        $productItem ['name'] = $value['product']->getName();
        $productItem ['price'] = $value['product']->getPrice();
        $productItem ['qte'] = $value['quantity'];
        $products[] = $productItem;  
    }
        $session =  Session::create([
            'line_items'=>[ //ce sont les produits qui vont être payé
                array_map(fn(array $product)=> [
                    'quantity' => $product['qte'],
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $product['name']
                        ],
                        'unit_amount' => $product['price']*100, //*100 car stripe prend les prix en centimes
                    ],
                ],$products)        
            ],
            'mode'=> 'payment', // précision du mode de paiement
            'cancel_url'=> 'http://127.0.0.1:8000/pay/cancel', // redirection en cas d'annulation/echec du paiement
            'success_url'=> 'http://127.0.0.1:8000/pay/success', // redirect si paie réussi
            'billing_address_collection'=> 'required', //on autorise les factures
            'shipping_address_collection'=>[    
                'allowed_countries' => ['FR', 'EG'],
            ], //pays dont on accepte les paiement
            'metadata'=>[
            ]
        ]);
        $this->redirectUrl = $session->url;
    }

    public function getStripeRedirectUrl(){
        return $this->redirectUrl;
    }
}    


