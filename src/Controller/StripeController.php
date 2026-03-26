<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StripeController extends AbstractController
{
    // #[Route('/stripe', name: 'app_stripe')]
    // public function index(): Response
    // {
    //     return $this->render('stripe/index.html.twig', [
    //         'controller_name' => 'StripeController',
    //     ]);
    // }

    #[Route('/pay/success', name: 'app_pay_success')]
    public function paySucces(): Response
    {
        return $this->render('stripe/index.html.twig', [
            'controller_name' => 'StripeController',
        ]);
    }

    #[Route('/pay/cancel', name: 'app_pay_cancel')]
    public function payCancel(): Response
    {
        return $this->render('stripe/cancel.html.twig', [
            'controller_name' => 'StripeController',
        ]);
    }

    #[Route('/stripe/notify', name: 'app_stripe_notify')]
    public function stripeNotify(Request $request,
                                 OrderRepository $orderRepository,
                                 EntityManagerInterface $entityManager
                                 ): Response
    {
        Stripe::setApiKey($_SERVER['STRIPE_SECRET_KEY']);

        // $endpoint_secret = 'whsec_c34715a38ef4b8cc6c2fa0fcd64e04c02762a081536bc3cdec62a8facf88bc52';
        $endpoint_secret = $_SERVER['STRIPE_SECRET_WEBHOOK'];
        $payload = $request->getContent();
        
        $sigHeader = $request->headers->get('Stripe-Signature');

        $event =null;
        try{
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sigHeader, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e){
            return new Response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e){
            return new Response('Invalid signature', 400);
        }
        switch ($event->type){
            case 'payment_intent.succeeded':
                $paymentIntent =$event->data->object;
                // $fileName = 'stripe-detail-'.uniqid().'txt';
                $orderId = $paymentIntent->metadata->orderId;
                $order = $orderRepository->find($orderId);
                $order->setIsPaymentCompleted(1);
                $entityManager->flush();
                // file_put_contents($fileName, $paymentIntent);
                // file_put_contents($fileName, $orderId);
                break;
            case 'payment_method.attached':
                $paymentMethod = $event->data->object;
                break;
            default:
                break;
        }
        return new Response ('Evènement reçu avec succès', 200);
    }
}
