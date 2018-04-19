<?php

namespace App\Controller;


use App\Services\GetTagOpenOrder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OrderController extends Controller
{
    public function show(GetTagOpenOrder $order) {

        $orderNumber = $order->getOrder($this->getUser())->getId();

        return $this->render('frontend/order/show.html.twig', [
            'orderNumber' => $orderNumber,
        ]);
    }
}