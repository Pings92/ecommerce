<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/users', name: 'app_user')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
            // 'controller_name' => 'UserController',
        ]);
    }

    #[Route('/admin/users/editRole/{id}', name: 'app_user_edit_role')]
    public function editRole(User $user, EntityManagerInterface $entityManagerInterface): Response
    {
            $userRole = $user->getRoles();

            if(in_array('ROLE_USER', $userRole)) {
                $user->setRoles( array('ROLE_EDITOR') );
                // $entityManagerInterface->persist($user);
                $entityManagerInterface->flush();
                $this->addFlash('success', 'Rôle modifié avec succès');
                // return $this->redirectToRoute('app_user');
            }
            else  {
                $user->setRoles( array('ROLE_USER') );
                // $entityManagerInterface->persist($user);
                $entityManagerInterface->flush();
                $this->addFlash('success', 'Rôle modifié avec succès');
                // return $this->redirectToRoute('app_user');
            }
            
            return $this->redirectToRoute('app_user');
    }

    #[Route('/admin/user/{id}/change-role/{role}', name: 'app_user_change_role')] //remettre la wildcard {role} pour selection du role en question
    public function changeRole(EntityManagerInterface $entityManager, User $user, $role): Response
    {
        $validRoles = ['ROLE_USER', 'ROLE_EDITOR']; // Liste des rôles valides
        
        if (!in_array($role, $validRoles, true)) {
            $this->addFlash('error', "Le rôle demandé n'est pas valide.");
            return $this->redirectToRoute('app_user');
        }
                if ($role !== 'ROLE_USER') {
            $user->setRoles([$role, 'ROLE_USER']);
        } else {
            $user->setRoles([$role]);
        }
        // Sauvegarde en base de données
        $entityManager->flush();
        // Message de confirmation
        $this->addFlash('success', "Le rôle $role a bien été attribué à l'utilisateur.");
        // Redirection vers la liste des utilisateurs
        return $this->redirectToRoute('app_user');
    }

    #[Route('/admin/user/{id}/remove/editor/role ', name: 'app_user_remove_editor_role')]
    public function removeRoleEditor(EntityManagerInterface $entityManager, User $user): Response
    {
        $user->setRoles([]);
        $entityManager->flush();

        $this->addFlash('danger', "Le rôle éditeur à bien été retiré à l'utilisateur");
        
        return $this->redirectToRoute('app_user');
    }

    #[Route('/admin/user/{id}/remove/', name: 'app_user_remove')]
    public function ruserRemove(EntityManagerInterface $entityManager,$id,  UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);
        $entityManager->remove($user);
        $entityManager->flush();

        $this->addFlash('danger', "L'utilisateur à bien été supprimé.");
        
        return $this->redirectToRoute('app_user');
    }

    // #[Route('/admin/users/delete/{id}', name: 'app_user_delete')]
    // public function deleteUser(EntitymanagerInterface $entityManagerInterface, UserRepository $userRepository): Response
    // {
    //     return $this->render('user/index.html.twig', []);
    // }
}
