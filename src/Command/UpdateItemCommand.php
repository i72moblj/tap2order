<?php

namespace App\Command;


use App\Entity\ItemChoice;
use App\Entity\Order;
use App\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @var integer
     */
    private $price;

    /**
     * @var string
     */
    private $status;

//    /**
//     * @var Collection
//     */
//    private $itemChoices;

    /**
     * UpdateItemCommand constructor.
     * @param int $id
     * @param int $quantity
     * @param int $price
     * @param string $status
     * @param Order $order
     * @param Product $product
//     * @param Collection $itemChoices
     */
//    public function __construct(int $id, int $quantity, int $price, string $status, Order $order, Product $product, Collection $itemChoices)
    public function __construct(int $id, int $quantity, int $price, string $status)
    {
        $this->id = $id;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->status = $status;
//        $this->itemChoices = new ArrayCollection();
//        $this->itemChoices = $itemChoices;
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
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

//    /**
//     * @return Collection
//     */
//    public function getItemChoices(): Collection
//    {
//        return $this->itemChoices;
//    }



}