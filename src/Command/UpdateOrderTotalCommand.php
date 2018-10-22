<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 22/10/18
 * Time: 11:10
 */

namespace App\Command;


use App\Entity\Order;

class UpdateOrderTotalCommand
{
    /**
     * @var Order $order
     */
    private $order;

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

}