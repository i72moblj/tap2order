<?php

namespace App\Handler;


use App\Command\AddItemToOrderCommand;
use App\Entity\Item;
use Doctrine\Common\Persistence\ObjectManager;

class AddItemToOrderHandler
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function handle(AddItemToOrderCommand $command)
    {
        $this->manager->getRepository(Item::class);

        $order = $command->getOrder();
        $product = $command->getProduct();
        $quantity = $command->getQuantity();
        $price = $command->getPrice();

        $item = new Item();
        $item
            ->setOrder($order)
            ->setProduct($product)
            ->setQuantity($quantity)
            ->setPrice($price)
        ;

        $this->manager->persist($item);
        $this->manager->flush();

        return $item;
    }
}