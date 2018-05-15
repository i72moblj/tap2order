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
     * @param int $id
     * @param int $quantity
     */
    public function __construct(int $id, int $quantity)
    {
        $this->id = $id;
        $this->quantity = $quantity;
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