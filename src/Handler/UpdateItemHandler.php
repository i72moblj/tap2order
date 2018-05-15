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

        $item = $this->manager->getRepository(Item::class)->find($id);
        $item->setQuantity($quantity);

        $this->manager->flush();

        return $item;
    }
}