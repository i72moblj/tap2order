<?php

namespace App\Handler;


use App\Command\UpdateItemCommand;
use App\Entity\Item;
use Doctrine\Common\Persistence\ObjectManager;

class UpdateItemHandler
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function handle(UpdateItemCommand $command) {
        $id = $command->getId();
        $quantity = $command->getQuantity();
        $price = $command->getPrice();
        $status = $command->getStatus();
//        $itemChoices = $command->getItemChoices();


        $item = $this->manager->getRepository(Item::class)->find($id);

        $item
            ->setQuantity($quantity)
            ->setPrice($price)
            ->setStatus($status)
        ;

        $this->manager->persist($item);
        $this->manager->flush();

        return $item;
    }
}