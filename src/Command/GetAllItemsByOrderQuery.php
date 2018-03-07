<?php

namespace App\Command;


/**
 * Class GetAllItemsByOrderQuery
 * @package App\Command
 */
class GetAllItemsByOrderQuery
{
    /**
     * @var int
     */
    private $orderId;

    /**
     * GetAllItemsByOrderQuery constructor.
     * @param int $orderId
     */
    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }
}