<?php

namespace App\Controller;


use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Subcategory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends Controller
{
    /**
     * @Route("/menu/{categorySlug}/{subcategorySlug}/{productSlug}", name="product_show")
     * @ParamConverter("category", options={"mapping" : {"categorySlug": "slug"}})
     * @ParamConverter("subcategory", options={"mapping" : {"subcategorySlug": "slug"}})
     * @ParamConverter("product", options={"mapping" : {"productSlug": "slug"}})
     */
    public function show(Category $category, Subcategory $subcategory, Product $product)
    {
        return $this->render('frontend/product/view.html.twig', [
            'product' => $product,
        ]);
    }
}