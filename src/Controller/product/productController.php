<?php


namespace App\Controller\product;

use App\Entity\Commande;
use App\Entity\Product;
use App\Form\CommandeType;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class productController extends AbstractController

{
    /**
     * @Route("accueil/product", name="product")
     */
    public function allProduct(ProductRepository $productRepository)
    {
        $product = $productRepository->findAll();

        return $this->render('product/product.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/accueil/product/show{id}", name="product_show_id")
     */
    public function getShowProduct(ProductRepository $productRepository, $id)
    {
        $product = $productRepository->find($id);

        return $this->render('product/product_show_id.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/accueil/product/search", name="get_product_by_ref_or_by_name")
     */
    public function getProductByRefOrByName(ProductRepository $productRepository, Request $request)
    {
        $ref = $request->query->get('ref');
        $name = $request->query->get('name');

        $product = $productRepository->getProductByRefOrByName($name, $ref);

        return $this->render('product/product.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/admin/accueil/product/delete/{id}", name="admin_product_delete_id")
     */
    public function deleteProduct(ProductRepository $productRepository, EntityManagerInterface $entityManager, $id)
    {//but supprimer un article dans SQL

        $product = $productRepository->find($id);

        // remove = efface
        $entityManager->remove($product);

        $entityManager->flush();

        //redirectToRoute= redirige vers la page de pages pour que l'on vois directemeent la suppression et qu'on puissent continuer a bosser
        return $this->redirectToRoute('product');
    }


    /**
     * @Route("/admin/accueil/product/update/{id}", name="admin_product_update_id")
     */
    public function updateProduct(ProductRepository $productRepository, Request $request, EntityManagerInterface $entityManager, $id)
    {
        $product = $productRepository->find($id);

        $form = $this->createForm(ProductType::class, $product);

        //= Si une methode post est passé
        if ($request->isMethod('post')) {
            //handlerequest = traite la requete
            $form->handleRequest($request);

            //isSubmitted = si un form est envoyé / isValid = si il est valide
            if ($form->isSubmitted() && $form->isValid()) {
                //persist=stocké
                $entityManager->persist($product);
                //flush=envoyé en BDD
                $entityManager->flush();
                return $this->redirectToRoute('product');
            }
        }

        // à partir de mon gabarit, je crée la vue de mon formulaire
        $formView = $form->createView();

        // je retourne un fichier twig, et je lui envoie ma variable qui contient
        // mon formulaire
        return $this->render('product/admin_product_update_id.html.twig', [
            'formView' => $formView
        ]);
    }

    /**
     * @Route("/accueil/product/product_insert", name="product_insert")
     */
     public function insertProduct(Request $request, EntityManagerInterface $entityManager)
     {
         //Je crée un nouvel article
         //J'utilise la gabarit de formulaire pour créer mon formulaire
         //J'envoie mon formulaire a un fichier twig
         //et je l'affiche

         //je crée un nouvel article/ en créant une nouvelle instance de l'entité product
         $product = new product();

         //J'utilise la methode createform pour créer le gabarit de formulaire pour le product: Producttype ( que j'ai generer ne ligne de commande
         //) et je lui associe mon entité product vide.
         $form = $this->createForm(ProductType::class, $product);

         //si je suis sur une methode post donc qu'un formulaire a été envoyé
         if ($request->isMethod('post')) {

             //je récupere les données de la method (post) et je les associes a mon formulaire
             $form->handleRequest($request);

             //Si les données de mon formulaires sont valide ( que les types dans les input sont bon, que tout les champs obligatoire sont remplis etc)
             if ($form->isValid()) {

                 //j'enregistre en BDD ma variable $product qui n'est plus vide car elle as été remplie avec les données du formulaire
                 $entityManager->persist($product);
                 $entityManager->flush();
                 return $this->redirectToRoute('product');
             }
         }

         $formView = $form->createView();

         return $this->render('product/product_insert.html.twig', ['formView' => $formView]);
     }

     ///**
    // * @Route("/accueil/product/commande/{id}", name="commande_id"
    //*/
    //public function commande(Request $request)
    //{
    //   $commande = new Commande();

    //   $form = $this ->createForm(CommandeType::class, $commande);

    //   if ($request->isMethod('Post')) {
    //       $form->handleRequest($request);
    //       if ($form->isSubmitted() && $form->isValid()) {
    //           $entityManager = $this->getDoctrine()->getManager();
    //           $entityManager->persist($commande);
    //           $entityManager->flush();

    //           $message = (new \Swift_Message(''))
    //               ->setSubject('Demande de commande')
    //               ->setFrom('atif.zourgani@lapiscine.pro')
    //               ->setTo('atif.zourganit@gmail.com')
    //               ->setBody('Demande de commande.
    //       }
    //   }
    //}

}