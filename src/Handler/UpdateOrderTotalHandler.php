<?php

namespace App\Handler;


use App\Command\UpdateOrderTotalCommand;
use App\Entity\Order;
use Doctrine\Common\Persistence\ObjectManager;

class UpdateOrderTotalHandler
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function handle(UpdateOrderTotalCommand $command)
    {
        $orderId = $command->getOrderId();
        $itemPrice = $command->getItemPrice();
        $itemQuantity = $command->getItemQuantity();

        $order = $this->manager->getRepository(Order::class)->find($orderId);

        $total = $order->getTotal();
        $total = $total + ($itemPrice * $itemQuantity);

        $order->setTotal($total);

        $this->manager->flush();

        return $order;
    }
}