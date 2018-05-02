<?php

namespace App\Controller;


use App\Command\GetAllItemsByOrderQuery;
use App\Services\GetTagOpenOrder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends Controller
{
    /**
     * @Route("/order", name="order_show")
     */
    public function show(GetTagOpenOrder $openOrder) {

        $order = $openOrder->getOrder($this->getUser());

        $items = $this->get('tactician.commandbus')->handle(
            new GetAllItemsByOrderQuery($order->getId())
        );

        return $this->render('frontend/order/show.html.twig', [
            'order' => $order,
            'items' => $items,
        ]);
    }
}