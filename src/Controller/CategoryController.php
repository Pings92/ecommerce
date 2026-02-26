<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
    #[Route('/category/new', name: 'app_category_new')]
    public function addCategory(EntityManagerInterface $taxi, Request $request): Response
    {
        $category = new Category();

        $formulaire = $this->createForm(CategoryFormType::class, $category);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $taxi->persist($category);
            $taxi->flush();
            }
        return $this->render('category/newCategory.html.twig', [
            'form' => $formulaire->createView(),
        ]);
    }

    #[Route('/category/update/{id}', name: 'app_category_update')]
        public function updateCategory (Category $category, EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        $form = $this-> createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManagerInterface->flush();

            return $this->redirectToRoute('app_category');
        }
    return $this->render('category/updateCategory.html.twig',[
        'form' => $form->createView(),
    ]);
    }
}