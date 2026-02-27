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
    public function editRole(User $user, EntityManagerInterface $entityManagerInterface, UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [

        ]);
    }

    // #[Route('/admin/users/delete/{id}', name: 'app_user_delete')]
    // public function deleteUser(EntitymanagerInterface $entityManagerInterface, UserRepository $userRepository): Response
    // {
    //     return $this->render('user/index.html.twig', []);
    // }
}
