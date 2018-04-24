<?php

namespace App\Handler;


use App\Command\AddItemCommand;
use App\Entity\Item;
use Doctrine\Common\Persistence\ObjectManager;

class AddItemHandler
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function handle(AddItemCommand $command)
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
    }
}