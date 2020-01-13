<?php


namespace App\Controller\galerie;

use App\Entity\Galerie;
use App\Form\GalerieType;
use App\Repository\GalerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

        $galerie = $galerieRepository->findBy([],['date' => 'DESC']);

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

        $galerie = $galerieRepository->getGalerieByDescriptionOrByName($description, $name);

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
     * @param Request $request
     * @return Response
     */
    public function insertGalerie(Request $request)
    {
        $galerie = new Galerie();

        $form = $this->createForm(GalerieType::class, $galerie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // stock toutes les images envoyées par le formulaire dans $images
            $image = $request->files->get('galerie')['image'];
            if ($image != null) {
                // stock le dossier de destination défini dans config/services.yaml
                $upload_directory = $this->getParameter('upload_directory');
                $filename = $request->request->get('galerie')['img'] . '.' . $image->guessExtension();

                // déplace le fichier dans le dossier désiré
                $image->move(
                // dossier de destination
                    $upload_directory,
                    // nom du fichier
                    $filename);
                // Ajoute le nom du fichier image à l'array Images dans la BDD
            }

            $galerie->setImg($filename);
            $galerie->setDate(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($galerie);
            $entityManager->flush();
            return $this->redirectToRoute('galerie');
        }
        return $this->render('galerie/galerie_insert.html.twig', ['galerie' => $galerie, 'form' => $form->createView(),]);
    }


    /**
     * @Route("/accueil/galerie/update/{id}", name="galerie_update_id")
     */
    public
    function updateGalerie(GalerieRepository $galerieRepository, Request $request, EntityManagerInterface $entityManager, $id)
    {
        $galerie = $galerieRepository->find($id);

        $form = $this->createForm(GalerieType::class, $galerie);

        //= Si une methode post est passé
        if ($request->isMethod('post')) {
            //handlerequest = traite la requete
            $form->handleRequest($request);

            //isSubmitted = si un form est envoyé / isValid = si il est valide
            if ($form->isSubmitted() && $form->isValid()) {
                //persist=stocké
                $entityManager->persist($galerie);
                //flush=envoyé en BDD
                $entityManager->flush();
                return $this->redirectToRoute('galerie');
            }
        }

        // à partir de mon gabarit, je crée la vue de mon formulaire
        $formView = $form->createView();

        // je retourne un fichier twig, et je lui envoie ma variable qui contient
        // mon formulaire
        return $this->render('galerie/galerie_update_id.html.twig', [
            'formView' => $formView
        ]);
    }

    /**
     * @Route("/accueil/galerie/update", name="galerie_update_ok")
     */
    public
    function updateGalerieOk(EntityManagerInterface $entityManager, Request $request, GalerieRepository $galerieRepository, $id)
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
        $galerie->setDate(new \DateTime($date));
        $galerie->setAuthor($authors);

        $entityManager->persist($galerie);
        $entityManager->flush();

        return $this->redirectToRoute('galerie');
    }
}