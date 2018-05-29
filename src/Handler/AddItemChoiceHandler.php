<?php

namespace App\Handler;


use App\Command\AddItemChoiceCommand;
use App\Entity\ItemChoice;
use Doctrine\Common\Persistence\ObjectManager;

class AddItemChoiceHandler
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function handle(AddItemChoiceCommand $command)
    {
        $this->manager->getRepository(ItemChoice::class);

        $item = $command->getItem();
        $choice =  $command->getChoice();
        $price = $command->getChoice()->getPrice();

        $itemChoice =  new ItemChoice();
        $itemChoice
            ->setItem($item)
            ->setChoice($choice)
            ->setPrice($price)
        ;

        $this->manager->persist($itemChoice);
        $this->manager->flush();
    }
}