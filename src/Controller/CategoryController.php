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
    #[Route('/admin/category', name: 'app_category')]
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
    #[Route('/admin/category/new', name: 'app_category_new')]
    public function addCategory(EntityManagerInterface $taxi, Request $request): Response
    {
        $category = new Category();

        $formulaire = $this->createForm(CategoryFormType::class, $category);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $taxi->persist($category);
            $taxi->flush();
            $this->addFlash('success', 'Catégorie ajoutée avec succès');
            return $this->redirectToRoute('app_category');
            }
        
        return $this->render('category/newCategory.html.twig', [
            'form' => $formulaire->createView(),
        ]);
    }

    #[Route('/admin/category/update/{id}', name: 'app_category_update')]
        public function updateCategory (Category $category, EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        $form = $this-> createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManagerInterface->flush();
            $this->addFlash('success', 'Catégorie modifiée avec succès');
            return $this->redirectToRoute('app_category');
        }
        return $this->render('category/updateCategory.html.twig',[
        'form' => $form->createView(),
    ]);
    }
    #[Route('/admin/category/delete/{id}', name: 'app_category_delete')]
    public function deleteCategory(Category $categoryASuprimer, EntityManagerInterface $entityManagerInterface): Response
    {
         // La méthode deleteCategory est actuellement vide, ce qui signifie qu'elle n'a pas encore été implémentée pour gérer la suppression d'une catégorie.
         // Pour implémenter la suppression d'une catégorie, vous devrez probablement injecter le repository de la catégorie et l'EntityManagerInterface,
         // puis utiliser ces outils pour trouver la catégorie à supprimer et effectuer la suppression de la base de données.
    $entityManagerInterface-> remove($categoryASuprimer);
    $entityManagerInterface-> flush();
    $this->addFlash('danger', 'Catégorie supprimée avec succès');// Ajoute un message flash pour indiquer que la catégorie a été supprimée avec succès
    //success est le type de message flash, et 'Catégorie supprimée avec succès' est le contenu du message qui sera affiché à l'utilisateur après la suppression de la catégorie.
    //success est un type de message flash qui indique que l'opération a été effectuée avec succès. Lorsque vous ajoutez un message flash de type success, il est généralement utilisé pour informer l'utilisateur que l'action qu'il a entreprise a été réalisée avec succès, comme la création, la mise à jour ou la suppression d'une ressource.
    //success correspond à une classe CSS qui peut être utilisée pour styliser le message flash de manière appropriée, souvent avec une couleur verte ou un indicateur visuel positif pour signaler le succès de l'opération.
    return $this->redirectToRoute('app_category');

    }
}