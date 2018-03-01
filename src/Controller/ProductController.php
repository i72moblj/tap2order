<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Command\GetAllProductsBySubcategoryQuery;

class ProductController extends Controller
{
    /**
     * @Route("/{subcategoryId}/products", name="product_index")
     */
    public function index($subcategoryId) {
        $products = $this->get('tactician.commandbus')->handle(
            new GetAllProductsBySubcategoryQuery($subcategoryId)
        );

        return $this->render('frontend/product/index.html.twig', [
            'products' => $products
        ]);
    }
}