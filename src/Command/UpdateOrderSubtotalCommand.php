<?php

namespace App\Command;


class UpdateOrderSubtotalCommand
{
    /**
     * @var int
     */
    private $orderId;

    /**
     * @var int
     */
    private $itemPrice;

    /**
     * @var int
     */
    private $itemQuantity;

    /**
     * UpdateOrderTotalCommand constructor.
     * @param $orderId
     * @param $itemPrice
     * @param $itemQuantity
     */
    public function __construct($orderId, $itemPrice, $itemQuantity)
    {
        $this->orderId = $orderId;
        $this->itemPrice = $itemPrice;
        $this->itemQuantity = $itemQuantity;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @return int
     */
    public function getItemPrice(): int
    {
        return $this->itemPrice;
    }

    /**
     * @return int
     */
    public function getItemQuantity(): int
    {
        return $this->itemQuantity;
    }

}