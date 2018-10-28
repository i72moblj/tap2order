<?php

namespace App\Controller\Frontend;


use App\Command\GetAllActiveOffersQuery;
use App\Command\UpdateOrderCommand;
use App\Entity\Offer;
use App\Entity\Order;
use App\Services\GetTagActiveOrderService;
use App\Services\GetTagOpenOrderService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends Controller
{
    /**
     * @Route("/comanda", name="order_show")
     *
     * @param Request $request
     * @param GetTagOpenOrderService $openOrder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Request $request, GetTagOpenOrderService $openOrder) {

        $order = $openOrder->getOrder($this->getUser());

        $form = $this->createFormBuilder($order)
            ->add('offer', EntityType::class, [
                'label' => 'Ofertas disponibles',
                'class' => Offer::class,
                'expanded' => true,
                'multiple' => false,
                'choices' => $this->get('tactician.commandbus')->handle(
                    new GetAllActiveOffersQuery()
                ),
            ])
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $order = $this->get('tactician.commandbus')->handle(
                new UpdateOrderCommand(
                    $order
                )
            );
        }

        return $this->render('frontend/order/show.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/comanda/add", name="order_add")
     *
     * @param GetTagOpenOrderService $openOrder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function add(GetTagOpenOrderService $openOrder)
    {
        $order = $openOrder->getOrder($this->getUser());

        $order->setStatus(Order::ACTIVE);

        $this->get('tactician.commandbus')->handle(
            new UpdateOrderCommand(
                $order
            )
        );

        return $this->redirectToRoute('order_status');
    }

    /**
     * @Route("/comanda/status", name="order_status")
     *
     * @param GetTagActiveOrder $activeOrder
     * @return Response
     */
    public function showStatus(GetTagActiveOrderService $activeOrder)
    {
        return new Response('hola');
    }
}