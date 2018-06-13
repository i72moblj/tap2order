<?php

namespace App\Controller\Frontend;


use App\Command\DeleteItemCommand;
use App\Command\UpdateItemCommand;
use App\Entity\Item;
use App\Form\DTO\EditItem;
use App\Form\EditItemType;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @Route("/item/{item}/update", name="item_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param Item $item
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, Item $item) {
        $editItem = new EditItem($item);

        $form = $this->createForm(EditItemType::class, $editItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Item $item */
            $item = $this->bus->handle(
                new UpdateItemCommand(
                    $editItem
                )
            );

            return $this->redirectToRoute('order_show');
        }

        return $this->render('frontend/item/edit.html.twig', [
            'form' => $form->createView(),
            'item' => $item,
        ]);

    }

    /**
     * @Route("/item/{item}/delete", name="item_delete")
     *
     * @param Item $item
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Item $item) {
        $this->bus->handle(
            new DeleteItemCommand(
                $item->getId()
            )
        );

        return $this->redirectToRoute('order_show');
    }

}