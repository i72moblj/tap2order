<?php

namespace App\Controller;


use App\Command\GetAllCategoriesQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends Controller
{
    /**
     * @Route("/menu", name="menu_index")
     */
    public function index()
    {
        $categories = $this->get('tactician.commandbus')->handle(
            new GetAllCategoriesQuery()
        );

        return $this->render('frontend/menu/index.html.twig', [
            'categories' => $categories,
        ]);
    }
}