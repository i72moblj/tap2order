<?php

namespace App\Controller;


use App\Command\GetAllItemsByOrderQuery;
use App\Command\GetAllOpenOrdersQuery;
use App\Services\GetTagOpenOrderService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends Controller
{
    /**
     * @Route("/comanda", name="order_show")
     */
    public function show(GetTagOpenOrderService $openOrder) {

        $order = $openOrder->getOrder($this->getUser());

        $this->get('tactician.commandbus')->handle(
            new GetAllItemsByOrderQuery($order->getId())
        );

        return $this->render('frontend/order/show.html.twig', [
            'order' => $order
        ]);
    }

    /**
     * @Route("/waiters/index", name="waiters_index")
     */
    public function waiterIndex() {
        $openOrders = $this->get('tactician.commandbus')->handle(
            new GetAllOpenOrdersQuery()
        );

        return $this->render('frontend/order/waiters_index.html.twig', [
            'openOrders' => $openOrders,
        ]);
    }
    
}