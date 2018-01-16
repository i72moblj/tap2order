<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Command\GetAllSubcategoriesQuery;

class SubcategoryController extends Controller
{
    /**
     * @Route("/{categoryId}/subcategories", name="subcategory_index")
     */
    public function index($categoryId)
    {
        $subcategories = $this->get('tactician.commandbus')->handle(
            new GetAllSubcategoriesQuery($categoryId)
        );

        return $this->render('frontend/subcategory/index.html.twig', [
            'subcategories' => $subcategories
        ]);
    }

}