<?php

namespace App\Controller\Frontend;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Command\GetAllCategoriesQuery;


class CategoryController extends Controller
{
    /**
     * @Route("/menu", name="category_index")
     */
    public function index()
    {
        $categories = $this->get('tactician.commandbus')->handle(
            new GetAllCategoriesQuery()
        );

        return $this->render('frontend/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

}

