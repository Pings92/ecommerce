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
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mime\Email;

final class OrderController extends AbstractController
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    #[Route('/order', name: 'app_order')]
    public function index(Request $request,
                          SessionInterface $session, 
                          ProductRepository $productRepository,
                          EntityManagerInterface $entityManager,
                          Cart $cart,
                          OrderRepository $orderRepository
                          ): Response
    {
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

            $html = $this->renderView('mail/orderConfirm.html.twig',[
                'order'=>$order
            ]);
            $email = (new Email())
            ->from('bidkad@hotmail.com')
            ->to($order->getEmail())
            ->subject('Confirmation de réception de la commande')
            ->html($html);
            $this->mailer->send($email);
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
    public function getAllOrder(UserRepository $userRepository,
                                PaginatorInterface $paginator,
                                OrderRepository $orderRepository,
                                Request $request,
                                ): Response
    {
        // $order = $orderRepository->findAll();
        $data= $orderRepository->findby([], ['id'=>"DESC"]);
        $order = $paginator->paginate(
        $data,
        $request->query->getInt('page',1),
        2
        );
        return $this->render('order/all_orders.html.twig',[
        'orders'=>$order
        ]);
    }

    #[Route('/editor/order/{id}/is-completed/update', name:'app_order_is-completed-update', methods: ['GET', 'POST'])]
    public function switchCompletedState($id, OrderRepository $orderRepository,
                                         EntityManagerInterface $entityManager,
                                         )
    {
        $statut = $orderRepository->find($id);
        $statut-> setIsCompleted(true);
        $entityManager->flush($statut);
        $this->addFlash('success', "Status modifié avec succès");
        return $this->redirectToRoute('app_order_shows', [
        ]);
        }

    #[Route('/editor/order/{id}/is-completed/delete', name:'app_order_is-completed-delete', methods: ['GET', 'POST'])]
    public function deleteOrder(Order $order,
                                         EntityManagerInterface $entityManager,
                                         )
    {
        $entityManager->remove($order);
        $entityManager->flush();
        $this->addFlash('danger', "Commande suprimmer avec succès");
        return $this->redirectToRoute('app_order_shows', [
        ]);
        }

}
