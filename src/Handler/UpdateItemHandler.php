<?php

namespace App\Handler;


use App\Command\AddItemChoiceCommand;
use App\Command\DeleteItemChoiceCommand;
use App\Command\UpdateItemCommand;
use App\Command\UpdateOrderSubtotalCommand;
use App\Entity\Item;
use App\Entity\ItemChoice;
use App\Entity\Order;
use App\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;
use League\Tactician\CommandBus;

class UpdateItemHandler
{
    private $manager;

    private $bus;

    public function __construct(ObjectManager $manager, CommandBus $bus)
    {
        $this->manager = $manager;
        $this->bus = $bus;
    }

    public function handle(UpdateItemCommand $command) {
        $id = $command->getId();
        $quantity = $command->getQuantity();

        $item = $this->manager->getRepository(Item::class)->find($id);

        // Se descuenta del total de la comanda el precio del item antiguo * cantidad antigua
        /** @var Order $order */
        $order = $item->getOrder();

        $this->bus->handle(
            new UpdateOrderSubtotalCommand($order->getId(), -$item->getPrice(), $item->getQuantity())
        );

        // Se eliminan los antiguos itemChoices
        $itemChoices = $item->getItemChoices();

        foreach ($itemChoices as $itemChoice) {
            $this->bus->handle(
                new DeleteItemChoiceCommand(
                    $itemChoice
                )
            );
        }

        // Se añaden los nuevos itemChoices
        // Se actualiza el precio del artículo en base al precio del producto más suplementos de los choices
        /** @var Product $product */
        $product = $item->getProduct();
        $price = $product->getPrice();

        $choices = $command->getChoices();

        foreach ($choices as $choice) {
            /** @var ItemChoice $itemChoice */
            $price = $price + $choice->getPrice();

            $this->bus->handle(
                new AddItemChoiceCommand(
                    $item,
                    $choice
                )
            );
        }

        // Se actualiza el artículo
        $item->setQuantity($quantity);
        $item->setPrice($price);

        $this->manager->flush();

        // Se actualiza precio total de la comanda con el precio del item nuevo * cantidad nueva
        $this->bus->handle(
            new UpdateOrderSubtotalCommand($order->getId(), $item->getPrice(), $item->getQuantity())
        );

        return $item;
    }
    
}