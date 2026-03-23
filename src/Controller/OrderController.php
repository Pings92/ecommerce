<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Order;
use App\Entity\OrderProducts;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use App\Services\Cart;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

final class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function index(Request $request,
                          SessionInterface $session, 
                          ProductRepository $productRepository,
                          EntityManagerInterface $entityManager,
                          Cart $cart): Response
    {
        // $cart = $session->get('cart', []);
        // $cartWithData = [];
        // foreach ($cart as $id => $quantity) {
        //         $cartWithData[] = [
        //             'product' => $productRepository -> find($id),
        //             'quantity' => $quantity
        //         ];
        // }
        // $total = array_sum(array_map(function ($item) {
        //     return $item['product']->getPrice()* $item['quantity'];
        //     }, $cartWithData));

        $data = $cart->getCart($session);

        $order = new Order;
        $form = $this->createform(OrderType::class, $order); 
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($order->isPayOnDelivery()){
                if(!empty($data['total'])){
                    $order->setTotalPrice($data['total']);
                    $order->setCreatedAt(new DateTimeImmutable());
                    $entityManager->persist($order);
                    $entityManager->flush();
                    // dd($data['cart']);
                    foreach($data['cart'] as $value){
                        $orderProduct = new OrderProducts();
                        $orderProduct -> setOrder($order);
                        $orderProduct -> setProduct($value['product']);
                        $orderProduct -> setQte($value['quantity']);
                        $entityManager -> persist($orderProduct);
                        $entityManager -> flush();
                    }
                }
            $session->set('cart', []); //retourne un panier vide une fois la commande passé
            return $this->redirectToRoute('app_message_order'); //après validation du panier nous ramène à la page panier
            }      
        }
            
        return $this->render('order/index.html.twig', [
            'form' => $form->createView(),
            // 'items' => $data['cart'],
            // 'items' => $cartWithData,
            'total' => $data['total'],
        ]);
    }
    
    #[Route('/city/{id}/shipping/cost', name: 'app_city_shipping_cost')]
    public function cityShippingCost(City $city): Response
    {
        $cityShippingPrice = $city->getShippingCost();

        return new Response(json_encode([
            'status' => 200, 
            'message' => 'on', 
            'content' => $cityShippingPrice
        ]));
    }

    #[Route('/order_message', name:'app_message_order')]
    public function orderMessage(): Response
    {
        return $this->render('order/order_message.html.twig');
    }

    #[Route('/editor/order', name:'app_order_shows', methods: ['GET'])]
    public function getAllOrder(UserRepository $userRepository, OrderRepository $orderRepository): Response
    {
        $order = $orderRepository->findAll();
        return $this->render('order/all_orders.html.twig',[
        'orders'=>$order
        ]);
    }

}
