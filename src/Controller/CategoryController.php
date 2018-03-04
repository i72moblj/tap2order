<?php

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Command\GetAllSubcategoriesByCategoryQuery;
use App\Entity\Category;

class CategoryController extends Controller
{
    /**
     * @Route("/menu/{categorySlug}", name="category_index")
     * @ParamConverter("category", options={"mapping": {"categorySlug": "slug"}})
     */
    public function index(Category $category)
    {
        $subcategories = $this->get('tactician.commandbus')->handle(
            new GetAllSubcategoriesByCategoryQuery($category->getId())
        );

        return $this->render('frontend/category/index.html.twig', [
            'category' => $category,
            'subcategories' => $subcategories,
        ]);
    }

}

