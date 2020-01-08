<?php


namespace App\Controller\galerie;

use App\Entity\Galerie;
use App\Form\GalerieType;
use App\Repository\GalerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class galerieController extends AbstractController
//AbstractController = permet d'accéder a des méthodes ( comme "render" ) qui sont déjà intégré a symfony

{
    /**
     * @Route("/accueil/galerie", name="galerie")
     */
    public function allGalerie(GalerieRepository $galerieRepository, Request $request)
    {
        $date = $request->query->get('date');

        $galerie = $galerieRepository->getGalerieOrderByDate($date);

        return $this->render('galerie/galerie.html.twig', ['galerie' => $galerie]);
    }

    /**
     * @Route("/accueil/galerie/show{id}", name="show_id")
     */
    public function getShowGalerie(GalerieRepository $galerieRepository, $id)
    {
        $galerie = $galerieRepository->find($id);

        return $this->render('galerie/show_id.html.twig', ['galerie' => $galerie]);
    }

    /**
     * @Route("/accueil/galerie_get_by", name="get_galerie_by_description_or_by_name")
     */
    public function getGalerieByDescriptionOrByName(GalerieRepository $galerieRepository, Request $request)
    {
        $description = $request->query->get('description');
        $name = $request->query->get('name');

        $galerie = $galerieRepository->getGalerieByDescriptionOrByName ($description, $name);

        return $this->render('galerie/galerie.html.twig', ['galerie' => $galerie]);
    }

    /**
     * @Route("/accueil/galerie/delete/{id}", name="galerie_delete_id")
     */
    public function deleteGalerie(GalerieRepository $galerieRepository, EntityManagerInterface $entityManager, $id)
    {//but supprimer un livre dans SQL

        $galerie = $galerieRepository->find($id);

        // remove = efface
        $entityManager->remove($galerie);

        $entityManager->flush();

        //redirectToRoute= redirige vers la page de pages pour que l'on vois directemeent la suppression et qu'on puissent continuer a bosser
        return $this->redirectToRoute('galerie');
    }

    /**
     * @Route("/accueil/galerie/galerie_insert", name="galerie_insert")
     */
    public function insertGalerie()
    {
        return $this->render('galerie/galerie_insert.html.twig');
    }

    /**
     * @Route("/accueil/galerie/galerie_insert_ok", name="galerie_insert_ok")
     */
    public function insertGalerieOk(EntityManagerInterface $entityManager, Request $request)
    {
        $name = $request->query->get('name');
        $description = $request->query->get('description');
        $alt = $request->query->get('alt');
        $date = $request->query->get('date');
        $authors = $request->query->get('authors');

        $galerie = new Galerie();

        $galerie->setName($name);
        $galerie->setDescription($description);
        $galerie->setAlt($alt);
        $galerie->setDate( new \DateTime($date));
        $galerie->setAuthor($authors);

        $entityManager->persist($galerie);
        $entityManager->flush();

        return $this->render('galerie_insert_ok.html.twig');

    }

    /**
     * @Route("/accueil/galerie/update/{id}", name="galerie_update_id")
     */
    public function updateGalerie (GalerieRepository $galerieRepository, $id)
    {
        $galerie = $galerieRepository->find($id);

        return $this->render('galerie/galerie_update_id.html.twig', ['galerie' => $galerie]);
    }

    /**
     * @Route("/accueil/galerie/update", name="galerie_update_ok")
     */
    public function updateGalerieOk (EntityManagerInterface $entityManager, Request $request, GalerieRepository $galerieRepository, $id)
    {
        $galerie = $galerieRepository->find($id);

        $name = $request->query->get('name');
        $description = $request->query->get('description');
        $alt = $request->query->get('alt');
        $date = $request->query->get('date');
        $authors = $request->query->get('authors');

        $galerie = new Galerie();

        $galerie->setName($name);
        $galerie->setDescription($description);
        $galerie->setAlt($alt);
        $galerie->setDate( new \DateTime($date));
        $galerie->setAuthor($authors);

        $entityManager->persist($galerie);
        $entityManager->flush();

        return $this->redirectToRoute('galerie');
    }
}