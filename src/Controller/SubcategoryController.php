<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Command\GetAllSubcategoriesByCategoryQuery;
use App\Entity\Category;

class SubcategoryController extends Controller
{
    /**
     * @Route("/menu/{slug}", name="subcategory_index")
     */
    public function index(Category $category)
    {
        $subcategories = $this->get('tactician.commandbus')->handle(
            new GetAllSubcategoriesByCategoryQuery($category->getId())
        );

        return $this->render('frontend/subcategory/index.html.twig', [
            'subcategories' => $subcategories
        ]);
    }

}

