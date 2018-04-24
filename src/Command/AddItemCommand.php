<?php

namespace App\Command;


use App\Entity\Order;
use App\Entity\Product;

class AddItemCommand
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
     * AddItemCommand constructor.
     * @param Order $order
     * @param Product $product
     * @param int $quantity
     * @param int $price
     */
    public function __construct(Order $order, Product $product, int $quantity, int $price)
    {
        $this->order = $order;
        $this->product = $product;
        $this->quantity = $quantity;
        $this->price = $price;
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


}