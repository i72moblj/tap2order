<?php

namespace App\Controller;


use App\Command\GetAllItemsByOrderQuery;
use App\Entity\Item;
use App\Services\GetTagOpenOrderService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends Controller
{
    /**
     * @Route("/order", name="order_show")
     */
    public function show(GetTagOpenOrderService $openOrder) {

        $order = $openOrder->getOrder($this->getUser());

        $items = $this->get('tactician.commandbus')->handle(
            new GetAllItemsByOrderQuery($order->getId())
        );

        $total = 0;
        foreach ($items as $item) {
            /** @var Item $item */
            $total = $total + ($item->getPrice() * $item->getQuantity());
        }

        return $this->render('frontend/order/show.html.twig', [
            'order' => $order,
            'items' => $items,
            'total' => $total,
        ]);
    }
}