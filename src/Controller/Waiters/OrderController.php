<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 12/06/18
 * Time: 23:35
 */

namespace App\Controller\Waiters;


use App\Command\GetAllOpenOrdersQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/waiters")
 */
class OrderController extends Controller
{
    /**
     * @Route("/index", name="waiters_index")
     */
    public function index() {
        $openOrders = $this->get('tactician.commandbus')->handle(
            new GetAllOpenOrdersQuery()
        );

        return $this->render('waiters/order/waiters_index.html.twig', [
            'openOrders' => $openOrders,
        ]);
    }

}