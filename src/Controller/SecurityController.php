<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController {

    /**
     * @Route("/user/login",name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function  login(AuthenticationUtils $authenticationUtils)
    {
        $lasUserName = $authenticationUtils->getLastUsername();
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('user/login/login.html.twig',[
            'last_username' => $lasUserName,
            'error' => $error
        ]);
    }

    /**
     * @Route("/deconnexion",name="logout")
     */
    public function logout()
    {

    }
}