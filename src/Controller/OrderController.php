<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OrderController extends Controller
{
    public function show() {
        $text = "Hola";

        return $this->render('frontend/order/show.html.twig', [
            'text' => $text,
        ]);
    }
}