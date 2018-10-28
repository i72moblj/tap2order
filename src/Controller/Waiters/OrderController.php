<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 12/06/18
 * Time: 23:35
 */

namespace App\Controller\Waiters;


use App\Command\GetAllOpenOrdersQuery;
use App\Command\UpdateItemStatusCommand;
use App\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends Controller
{
    /**
     * @Route("/waiters", name="waiters_index")
     */
    public function index() {
        $orders = $this->get('tactician.commandbus')->handle(
            new GetAllOpenOrdersQuery()
        );

        return $this->render('waiters/order/waiters_index.html.twig', [
            'orders' => $orders,
        ]);
    }

    /**
     * @Route("/waiters/{item}/served", name="item_served")
     *
     * @param Item $item
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function setServed(Item $item)
    {
        /** @var Item $item */
        $item->setStatus(Item::SERVED);

        $this->get('tactician.commandbus')->handle(
            new UpdateItemStatusCommand(
                $item,
                Item::SERVED
            )
        );

        return $this->redirectToRoute('waiters_index');
    }

}