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
     * @var int
     */
    private $price;

    /**
     * addItemChoiceCommand constructor.
     * @param Item $item
     * @param Choice $choice
     * @param int $price
     */
    public function __construct(Item $item, Choice $choice, int $price)
    {
        $this->item =  $item;
        $this->choice =  $choice;
        $this->price = $price;
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

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }



}