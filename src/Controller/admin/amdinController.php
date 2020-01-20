<?php


namespace App\Controller\admin;

use App\Form\UsersType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class amdinController extends AbstractController
{
    /**
     * @Route("/admin/accueil/page_admin", name="page_admin")
     */
    public function adminPage(UserRepository $userRepository)
    {
        $user = $userRepository->findAll();

        return $this->render('admin/admin.html.twig', ['user' => $user]);
    }

     /**
     * @Route("/admin/accueil/update_admin{id}", name="update_admin_id")
     */
    public function udapteAdmin(UserRepository $userRepository, Request $request, EntityManagerInterface $entityManager , $id)
    {
        $user = $userRepository->find($id);

        $form = $this->createForm(UsersType::class, $user);

        //= Si une methode post est passé
        if ($request->isMethod('post')) {
            //handlerequest = traite la requete
            $form->handleRequest($request);

            //isSubmitted = si un form est envoyé / isValid = si il est valide
            if ($form->isSubmitted() && $form->isValid()) {
                //persist=stocké
                $entityManager->persist($user);
                //flush=envoyé en BDD
                $entityManager->flush();
                return $this->redirectToRoute('page_admin');
            }
        }

        // à partir de mon gabarit, je crée la vue de mon formulaire
        $formView = $form->createView();

        // je retourne un fichier twig, et je lui envoie ma variable qui contient
        // mon formulaire
        return $this->render('admin/update_admin_id.html.twig', [
            'formView' => $formView
        ]);
    }
}