<?php

namespace App\Command;


use App\Entity\Choice;
use App\Entity\Item;

class AddItemChoiceCommand
{
    /**
     * @var Item
     */
    private $item;

    /**
     * @var Choice
     */
    private $choice;

    /**
     * addItemChoiceCommand constructor.
     * @param Item $item
     * @param Choice $choice
     */
    public function __construct(Item $item, Choice $choice)
    {
        $this->item =  $item;
        $this->choice =  $choice;
    }

    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * @return Choice
     */
    public function getChoice(): Choice
    {
        return $this->choice;
    }
}