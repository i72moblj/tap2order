<?php

namespace App\Form\DTO;


use App\Entity\Choice;
use App\Entity\Item;
use App\Entity\ItemChoice;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


class EditItem
{
    /**
     * @var Item
     */
    private $item;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var Collection
     */
    private $choices;

    /**
     * @var Collection
     */
    private $itemChoices;

    public function __construct()
    {
        $this->choices = new ArrayCollection();
        $this->itemChoices = new ArrayCollection();
        $this->quantity = 0;
//        $this->itemChoices = $this->item->getItemChoices();
//        $this->quantity = $this->item->getQuantity();
    }

    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * @param Item $item
     * @return EditItem
     */
    public function setItem(Item $item): EditItem
    {
        $this->item = $item;

        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return EditItem
     */
    public function setQuantity(int $quantity): EditItem
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getChoices(): Collection
    {
        return $this->choices;
    }

    /**
     * @param Choice $choice
     * @return EditItem
     */
    public function addChoice(Choice $choice)
    {
        $this->choices[] = $choice;

        return $this;
    }

    /**
     * @param Choice $choice
     */
    public function removeChoice(Choice $choice)
    {
        $this->choices->removeElement($choice);
    }

    /**
     * @return Collection
     */
    public function getItemChoices(): Collection
    {
        return $this->itemChoices;
    }

    /**
     * @param ItemChoice $itemChoice
     * @return EditItem;
     */
    public function addItemChoice(ItemChoice $itemChoice)
    {
        $this->itemChoices[] = $itemChoice;

        return $this;
    }

    /**
     * @param ItemChoice $itemChoice
     */
    public function removeItemChoice(ItemChoice $itemChoice)
    {
        $this->itemChoices->removeElement($itemChoice);
    }

}