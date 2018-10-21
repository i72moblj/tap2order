<?php

namespace App\Handler;


use App\Command\UpdateOrderSubtotalCommand;
use App\Entity\Order;
use Doctrine\Common\Persistence\ObjectManager;

class UpdateOrderSubtotalHandler
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function handle(UpdateOrderSubtotalCommand $command)
    {
        $orderId = $command->getOrderId();
        $itemPrice = $command->getItemPrice();
        $itemQuantity = $command->getItemQuantity();

        $order = $this->manager->getRepository(Order::class)->find($orderId);

        $subtotal = $order->getSubtotal() + ($itemPrice * $itemQuantity);

        $order->setSubtotal($subtotal);

        $this->manager->flush();

        return $order;
    }
}