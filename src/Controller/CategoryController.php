<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $repo): Response // La méthode index reçoit une instance de CategoryRepository en tant que paramètre,
    // ce qui lui permet d'accéder aux méthodes de ce repository pour interagir avec la base de données.
    // La méthode index est responsable de récupérer toutes les catégories de la base de données et de les passer à la vue Twig pour affichage.
    // En utilisant l'injection de dépendance, Symfony fournit automatiquement une instance de CategoryRepository à la méthode index,
    // ce qui facilite l'accès aux données des catégories sans
    // avoir à créer manuellement une instance du repository.
    {
        $categories = $repo->findAll(); // Récupère toutes les catégories de la base de données
        return $this->render('category/index.html.twig', [
            'mesCategoriesExistante' => $categories, // Passe les catégories à la vue pour affichage 
            // 'mesCategoriesExistante' est le nom de la variable que nous utiliserons dans la vue Twig pour accéder aux catégories
            // $categories est la variable qui contient les catégories récupérées de la base de données via le repository
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
    #[Route('/category/delete/{id}', name: 'app_category_delete')]
    public function deleteCategory(Category $categoryASuprimer, EntityManagerInterface $entityManagerInterface): Response
    {
         // La méthode deleteCategory est actuellement vide, ce qui signifie qu'elle n'a pas encore été implémentée pour gérer la suppression d'une catégorie.
         // Pour implémenter la suppression d'une catégorie, vous devrez probablement injecter le repository de la catégorie et l'EntityManagerInterface,
         // puis utiliser ces outils pour trouver la catégorie à supprimer et effectuer la suppression de la base de données.
    $entityManagerInterface-> remove($categoryASuprimer);
    $entityManagerInterface-> flush();

    return $this->redirectToRoute('app_category');

    }
}