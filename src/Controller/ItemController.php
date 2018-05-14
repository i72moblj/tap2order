<?php

namespace App\Controller;


use App\Command\UpdateItemCommand;
use App\Entity\Item;
use App\Form\DTO\EditItem;
use App\Form\EditItemType;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends Controller
{
    private $bus;

    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @Route("/item/update/{item}", name="item_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param Item $item
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, Item $item) {
        $editItem = new EditItem();
        $editItem->setItem($item);
        $editItem->setQuantity($item->getQuantity());
        dump($item);

        $form = $this->createForm(EditItemType::class, $editItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->bus->handle(
                new UpdateItemCommand(
                    $item->getId(),
                    $form->get('quantity')->getData(),
                    $item->getPrice(),
                    $item->getStatus(),
                    $item->getOrder(),
                    $item->getProduct()
                )
            );

            return $this->redirectToRoute('order_show');
        }












//        if ($form->isSubmitted() && $form->isValid()) {
//            $item = $this->bus->handle(
//                new AddItemCommand(
//                    $this->get(GetTagOpenOrder::class)->getOrder($this->getUser()),
//                    $product,
//                    $form->get('quantity')->getData(),
//                    $product->getPrice()
//                )
//            );
//
//            $choices = $form->get('choices')->getData();
//
//            foreach ($choices as $choice) {
//                $this->bus->handle(
//                    new AddItemChoiceCommand(
//                        $item,
//                        $choice
//                    )
//                );
//            }
//
//            return $this->redirectToRoute('homepage');
//        }










//        $form = $this->createFormBuilder($item)
//            ->add('quantity', TextType::class, [
//                'label' => 'Cantidad',
//            ])
//            ->getForm();

        return $this->render('frontend/item/edit.html.twig', [
            'form' => $form->createView(),
            'item' => $item,
        ]);

    }

}