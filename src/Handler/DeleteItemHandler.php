<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 17/05/18
 * Time: 0:34
 */

namespace App\Handler;


use App\Command\DeleteItemCommand;
use App\Command\UpdateOrderDiscountCommand;
use App\Command\UpdateOrderSubtotalCommand;
use App\Entity\Item;
use Doctrine\Common\Persistence\ObjectManager;
use League\Tactician\CommandBus;

class DeleteItemHandler
{
    private $manager;

    private $bus;

    public function __construct(ObjectManager $manager, CommandBus $bus)
    {
        $this->manager = $manager;
        $this->bus = $bus;
    }

    public function handle(DeleteItemCommand $command) {
        $id = $command->getId();

        $item = $this->manager->getRepository(Item::class)->find($id);

        // Se descuenta del total de la comanda el precio del item eliminado * cantidad que aparecía.
        /** @var Order $order */
        $order = $item->getOrder();

        $this->bus->handle(
            new UpdateOrderSubtotalCommand($order->getId(), -$item->getPrice(), $item->getQuantity())
        );

        $this->bus->handle(
            new UpdateOrderDiscountCommand(
                $order
            )
        );

        $this->manager->remove($item);
        $this->manager->flush();
    }

}