<?php

namespace App\Controller;

use App\Command\GetAllCategoriesQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/categories", name="categories")
     */
    public function categoryAction()
    {
        $categories = $this->get('tactician.commandbus')->handle(
            new GetAllCategoriesQuery()
        );

        return $this->render('home/category.html.twig', [
            'categories' => $categories,
        ]);
    }
}