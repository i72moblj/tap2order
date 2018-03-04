<?php

namespace App\Controller;


use App\Entity\Category;
use App\Entity\Subcategory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Command\GetAllProductsBySubcategoryQuery;

class SubcategoryController extends Controller
{
    /**
     * @Route("/menu/{categorySlug}/{subcategorySlug}", name="subcategory_index")
     * @ParamConverter("category", options={"mapping": {"categorySlug": "slug"}})
     * @ParamConverter("subcategory", options={"mapping": {"subcategorySlug": "slug"}})
     */
    public function index(Category $category, Subcategory $subcategory) {
        $products = $this->get('tactician.commandbus')->handle(
            new GetAllProductsBySubcategoryQuery($subcategory->getId())
        );

        return $this->render('frontend/subcategory/index.html.twig', [
            'category' => $category,
            'subcategory' => $subcategory,
            'products' => $products,
        ]);
    }
}