<?php

namespace App\Command;


use App\Entity\Order;
use App\Entity\Product;
use App\Form\DTO\AddItem;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class AddItemToOrderCommand
{
    /**
     * @var Order
     */
    private $order;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var int
     */
    private $price;

    /**
     * @var Collection
     */
    private $choices;

    /**
     * AddItemCommand constructor.
     * @param Order $order
     * @param AddItem $addItem
     */
    public function __construct(Order $order, AddItem $addItem)
    {
        $this->order = $order;
        $this->product = $addItem->getProduct();
        $this->quantity = $addItem->getQuantity();
        $this->price = $addItem->getProduct()->getPrice();
        $this->choices = $addItem->getChoices();
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return Collection
     */
    public function getChoices(): Collection
    {
        return $this->choices;
    }

}