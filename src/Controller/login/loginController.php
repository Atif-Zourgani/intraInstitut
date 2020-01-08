<?php


namespace App\Controller\login;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class loginController extends AbstractController
//AbstractController = permet d'accéder a des méthodes ( comme "render" ) qui sont déjà intégré a symfony

{
    /**
     * @Route("/", name="loginAccueil")
     */
    public function loginAccueil()
    {
        //Renvois a la page d'accueil une fois que l'on est connecté
        //if ( 'role_user' == true){

            //return $this->redirectToRoute('accueil');}

        return $this->render('login/loginAccueil.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function  contact()
    {
        //Renvois a la page d'accueil une fois que l'on est connecté
        //if ("is_AUTHENTICATED_REMEMBERED"== true){

            //return $this->redirectToRoute('accueil');}

        return $this->render('login/contact.html.twig');
    }

}