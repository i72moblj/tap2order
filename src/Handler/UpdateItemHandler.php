<?php

namespace App\Handler;


use App\Command\AddItemChoiceCommand;
use App\Command\DeleteItemChoiceCommand;
use App\Command\UpdateItemCommand;
use App\Entity\Item;
use App\Entity\ItemChoice;
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

        $price = $item->getPrice();

        // Se eliminan los antiguos itemChoices y se descuentan los suplementos de precio de los Choices
        $itemChoices = $item->getItemChoices();

        foreach ($itemChoices as $itemChoice) {
            /** @var ItemChoice $itemChoice */
            $price = $price - $itemChoice->getChoice()->getPrice();

            $this->bus->handle(
                new DeleteItemChoiceCommand(
                    $itemChoice
                )
            );
        }

        // Se añaden los nuevos itemChoices y se añaden los suplementos de precio de los Choices
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

        $item->setPrice($price);

        $this->manager->flush();

        return $item;
    }
    
}