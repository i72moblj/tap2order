<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HomeControler extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('layout.html.twig');
    }
}