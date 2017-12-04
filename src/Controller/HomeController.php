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
    public function index()
    {
        $categories = $this->get('tactician.commandbus')->handle(
            new GetAllCategoriesQuery()
        );

        dump($categories);

        return $this->render('home/index.html.twig', [
            'categories' => $categories,
        ]);
    }
}