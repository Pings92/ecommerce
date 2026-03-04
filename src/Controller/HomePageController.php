<?php

namespace App\Controller;

use App\Form\DisplayProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();
        return $this->render('home_page/index.html.twig', [
            // 'controller_name' => 'HomePageController',
            'products'=> $products
        ]);
    }

    // #[Route('/display', name: 'app_product_on_home_page')]
    // public function showProductHomepage($id, ProductRepository $productRepository): Response
    // {
    //     $products = $productRepository->findAll();
    //     // $form = $this->createForm(DisplayProductType::class, $product);

    //     return $this->render('product/index.html.twig', [
    //         // 'products' => $productRepository->findAll(),
    //     ]);
    // }
    }

