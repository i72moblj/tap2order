<?php

namespace App\Controller;


use App\Command\GetAllCategoriesQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends Controller
{
    /**
     * @Route("/categories", name="category_index")
     */
    public function index()
    {
        $categories = $this->get('tactician.commandbus')->handle(
            new GetAllCategoriesQuery()
        );

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }
}