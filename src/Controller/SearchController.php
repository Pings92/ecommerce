<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search',methods: ['GET', 'POST'])]
    public function index(ProductRepository $productRepository, Request $request): Response
    {
        // $keyword= 'le search de ma nav bar';
        $product = $request->query->get('search-term');
        
        // $search = $productRepository->searchEngine('Ma variable qui va être les mots du client dans la barre de recherche keyword dans mon cas');

        // requirement:[_method:POST];
        
        //possibilité 1
        // $this->getRequest()->isMethod('POST');
        
        //possibilité 2
        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            if ($request->isMethod('POST')){
                    $search = $productRepository->searchEngine('$keyword');
                    dd($search);
                }
        }

        return $this->redirect('search/index.html.twig', [
            'products' => $product,
        ]);
    }

        #[Route('/search', name: 'app_search',methods: ['GET', 'POST'])]
    public function index(ProductRepository $productRepository, Request $request): Response
    {
        // $keyword= 'le search de ma nav bar';
        $product = $request->query->get('search-term');
        
        // $search = $productRepository->searchEngine('Ma variable qui va être les mots du client dans la barre de recherche keyword dans mon cas');

        // requirement:[_method:POST];
        
        //possibilité 1
        // $this->getRequest()->isMethod('POST');
        
        //possibilité 2
        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            if ($request->isMethod('POST')){
                    $search = $productRepository->searchEngine('$keyword');
                    dd($search);
                }
        }

        return $this->redirect('search/index.html.twig', [
            'products' => $product,
        ]);
}
