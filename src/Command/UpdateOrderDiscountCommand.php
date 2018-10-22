<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 22/10/18
 * Time: 0:13
 */

namespace App\Command;


use App\Entity\Order;

class UpdateOrderDiscountCommand
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