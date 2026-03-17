<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function index(): Response
    {
        $order = New Order();
        $form = $this->createform(OrderType::class, $order);
        return $this->render('order/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
