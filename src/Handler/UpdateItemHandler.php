<?php

namespace App\Handler;


use App\Command\AddItemChoiceCommand;
use App\Command\DeleteItemChoiceCommand;
use App\Command\UpdateItemCommand;
use App\Entity\Item;
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
        $item->setQuantity($quantity);

        $this->manager->flush();

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
        $choices = $command->getChoices();

        foreach ($choices as $choice) {
                $this->bus->handle(
                    new AddItemChoiceCommand(
                        $item,
                        $choice
                    )
                );
            }

        return $item;
    }
    
}