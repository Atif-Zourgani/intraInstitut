<?php


namespace App\Controller\accueil;


use App\Repository\GalerieRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class accueilController extends AbstractController
//AbstractController = permet d'accéder a des méthodes ( comme "render" ) qui sont déjà intégré a symfony

{
    /**
     * @Route("/login/accueil", name="accueil")
     */
    public function accueil(GalerieRepository $galerieRepository, ProductRepository $productRepository)
    {
        $galerie = $galerieRepository->findBy([],['date' => 'DESC']);
        $product = $productRepository->findAll();

        return $this->render('accueil/accueil.html.twig', ['galerie' => $galerie, 'product' => $product]);
    }
}
