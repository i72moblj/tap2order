<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 20/10/18
 * Time: 3:12
 */

namespace App\Command;


use App\Entity\Order;

class UpdateOrderCommand
{
    /**
     * @var Order $order
     */
    private $order;

    /**
     * UpdateOrderCommand constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @param Order $order
     */
    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }
}