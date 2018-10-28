<?php
/**
 * Created by PhpStorm.
 * User: soporteeps
 * Date: 10/07/18
 * Time: 7:53
 */

namespace App\Controller\Kitchen;


use App\Command\GetAllOpenOrdersQuery;
use App\Command\UpdateItemStatusCommand;
use App\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends Controller
{
    /**
     * @Route("/kitchen", name="kitchen_index")
     */
    public function kitchenIndex()
    {
        $orders = $this->get('tactician.commandbus')->handle(
            new GetAllOpenOrdersQuery()
        );

        return $this->render('kitchen/order/kitchen_index.html.twig', [
            'orders' => $orders,
        ]);
    }

    /**
     * @Route("/kitchen/{item}/elaborated", name="item_elaborated")
     *
     * @param Item $item
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function setElaborated(Item $item)
    {
        /** @var Item $item */
        $item->setStatus(Item::PREPARED);

        $this->get('tactician.commandbus')->handle(
            new UpdateItemStatusCommand(
                $item,
                Item::PREPARED
            )
        );

        return $this->redirectToRoute('kitchen_index');
    }
}