<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserProfile;
use App\Repository\UserProfileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class UserProfileController extends AbstractController
{
    #[Route('/profile-list', name: 'profile-list')]
    public function getListOfProfile(UserProfileRepository $profileRepository): Response
    {

        $user = new User();
        $user->setUsername('Vasile')
            ->setPassword('1234');

        $userProfile = new UserProfile();
        $userProfile->setUser($user);

        $profileRepository->save($userProfile,true);

        return $this->render('user/index.html.twig', [
            'userProfile' => $userProfile
        ]);


    }
}