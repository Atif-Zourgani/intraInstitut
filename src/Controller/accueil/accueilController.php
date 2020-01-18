<?php


namespace App\Controller\accueil;


use App\Repository\GalerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class accueilController extends AbstractController
//AbstractController = permet d'accéder a des méthodes ( comme "render" ) qui sont déjà intégré a symfony

{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil(GalerieRepository $galerieRepository)
    {
        $galerie = $galerieRepository->findBy([],['date' => 'DESC']);

        return $this->render('accueil/accueil.html.twig', ['galerie' => $galerie]);
    }
}
