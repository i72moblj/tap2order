<?php

namespace App\Command;


use App\Entity\Item;

class UpdateItemCommand
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * UpdateItemCommand constructor.
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->id = $item->getId();
        $this->quantity = $item->getQuantity();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}