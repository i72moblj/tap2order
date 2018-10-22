<?php

namespace App\Controller\Frontend;


use App\Command\GetAllActiveOffersQuery;
use App\Command\UpdateOrderCommand;
use App\Command\UpdateOrderDiscountCommand;
use App\Entity\Offer;
use App\Services\GetTagOpenOrderService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

            $order = $this->get('tactician.commandbus')->handle(
                new UpdateOrderDiscountCommand(
                    $order
                )
            );
        }

        return $this->render('frontend/order/show.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }

}