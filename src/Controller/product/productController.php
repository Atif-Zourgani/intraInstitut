<?php


namespace App\Controller\product;

use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class productController extends AbstractController

{
    /**
     * @Route("accueil/product", name="product")
     */
    public function allProduct()
    {
        return $this->render('product/product.html.twig');
    }
}