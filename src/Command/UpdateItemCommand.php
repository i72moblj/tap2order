<?php

namespace App\Command;


use App\Form\DTO\EditItem;
use Doctrine\Common\Collections\Collection;

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
     * @var Collection
     */
    private $choices;

    /**
     * UpdateItemCommand constructor.
     * @param EditItem $editItem
     */
    public function __construct(EditItem $editItem)
    {
        $this->id = $editItem->getItem()->getId();
        $this->quantity = $editItem->getQuantity();
        $this->choices = $editItem->getChoices();
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

    /**
     * @return Collection
     */
    public function getChoices(): Collection
    {
        return $this->choices;
    }

}