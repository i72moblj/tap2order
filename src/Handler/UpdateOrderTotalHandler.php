<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 22/10/18
 * Time: 11:11
 */

namespace App\Handler;


use App\Command\UpdateOrderTotalCommand;
use App\Entity\Offer;
use App\Entity\Order;
use Doctrine\Common\Persistence\ObjectManager;

class UpdateOrderTotalHandler
{
    /**
     * @var ObjectManager $manager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function handle(UpdateOrderTotalCommand $command)
    {
        /** @var Order $order */
        $order = $command->getOrder();

        $total = $order->getSubtotal() - $order->getDiscount();
        $order->setTotal($total);

        $this->manager->flush();

        return $order;
    }
}