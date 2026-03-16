<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CartController extends AbstractController
{   
    public function __construct(private readonly ProductRepository $productRepository
    ){
    }

    #[Route('/cart', name: 'app_cart', methods: ['GET'])]
    
    // public function index(int $id,  $request): Response -> Pierick
    public function index(int $id, SessionInterface $session): Response

    {
        $product= $this->productRepository->getby($id);
        $session = $request->getSession();

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
}
