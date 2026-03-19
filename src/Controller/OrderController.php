<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\ProductRepository;
use Doctrine\ORM\Query\Expr\Func;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

final class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function index(Request $request, SessionInterface $session, ProductRepository $productRepository): Response
    {
        $cart = $session->get('cart', []);
        $cartWithData = [];
        foreach ($cart as $id => $quantity) {
                $cartWithData[] = [
                    'product' => $productRepository -> find($id),
                    'quantity' => $quantity
                ];
        }
        $total = array_sum(array_map(function ($item) {
            return $item['product']->getPrice()* $item['quantity'];
            }, $cartWithData));

        $order = New Order();
        $form = $this->createform(OrderType::class, $order); 
        $form ->handleRequest($request);
            
        return $this->render('order/index.html.twig', [
            'form' => $form->createView(),
            'items' => $cartWithData,
            'total' => $total,
        ]);
    }
    #[Route('/city/{id}/shipping/cost', name: 'app_city_shipping_cost')]
    public function cityShippingCost(City $city): Response
    {
        $cityShippingPrice = $city->getShippingCost();
        
        return new response($cityShippingPrice);
    ;}
}
