<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 20/10/18
 * Time: 3:14
 */

namespace App\Handler;


use App\Command\UpdateOrderCommand;
use Doctrine\Common\Persistence\ObjectManager;

class UpdateOrderHandler
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function handle(UpdateOrderCommand $command)
    {
        $order = $command->getOrder();

        $this->manager->flush();

        return $order;
    }
}