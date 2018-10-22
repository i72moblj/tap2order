<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 20/10/18
 * Time: 3:14
 */

namespace App\Handler;


use App\Command\UpdateOrderCommand;
use App\Command\UpdateOrderDiscountCommand;
use App\Command\UpdateOrderTotalCommand;
use Doctrine\Common\Persistence\ObjectManager;
use League\Tactician\CommandBus;

class UpdateOrderHandler
{
    private $manager;

    private $bus;

    public function __construct(ObjectManager $manager, CommandBus $bus)
    {
        $this->manager = $manager;
        $this->bus = $bus;
    }

    public function handle(UpdateOrderCommand $command)
    {
        $order = $command->getOrder();

        $this->bus->handle(
            new UpdateOrderDiscountCommand(
                $order
            )
        );

        $this->bus->handle(
            new UpdateOrderTotalCommand(
                $order
            )
        );

        $this->manager->flush();

        return $order;
    }
}