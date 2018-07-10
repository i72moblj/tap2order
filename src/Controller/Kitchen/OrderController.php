<?php
/**
 * Created by PhpStorm.
 * User: soporteeps
 * Date: 10/07/18
 * Time: 7:53
 */

namespace App\Controller\Kitchen;


use App\Command\GetAllOpenOrdersQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends Controller
{
    /**
     * @Route("/kitchen", name="kitchen_index")
     */
    public function kitchenIndex()
    {
        $openOrders = $this->get('tactician.commandbus')->handle(
            new GetAllOpenOrdersQuery()
        );

        return $this->render('kitchen/order/kitchen_index.html.twig', [
            'openOrders' => $openOrders,
        ]);
    }
}