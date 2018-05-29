<?php

namespace App\Handler;


use App\Command\AddItemChoiceCommand;
use App\Command\AddItemToOrderCommand;
use App\Entity\Item;
use Doctrine\Common\Persistence\ObjectManager;
use League\Tactician\CommandBus;

class AddItemToOrderHandler
{
    private $manager;

    private $bus;

    public function __construct(ObjectManager $manager, CommandBus $bus)
    {
        $this->manager = $manager;
        $this->bus = $bus;
    }

    public function handle(AddItemToOrderCommand $command)
    {
        $this->manager->getRepository(Item::class);

        $order = $command->getOrder();
        $product = $command->getProduct();
        $quantity = $command->getQuantity();
        $price = $command->getPrice();
        $choices = $command->getChoices();

        $item = new Item();
        $item
            ->setOrder($order)
            ->setProduct($product)
            ->setQuantity($quantity)
            ->setPrice($price)
        ;

        foreach ($choices as $choice) {
            $this->bus->handle(
                new AddItemChoiceCommand(
                    $item,
                    $choice
                )
            );
        }

        $this->manager->persist($item);
        $this->manager->flush();

        return $item;
    }
}