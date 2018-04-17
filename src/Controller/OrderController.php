<?php

namespace App\Controller;


use App\Service\getTagOpenOrder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OrderController extends Controller
{
    public function show(getTagOpenOrder $order) {

        $orderNumber = $order->getOrder($this->getUser())->getId();

        return $this->render('frontend/order/show.html.twig', [
            'orderNumber' => $orderNumber,
        ]);
    }
}