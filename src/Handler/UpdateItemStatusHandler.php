<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 28/10/18
 * Time: 23:10
 */

namespace App\Handler;


use App\Command\UpdateItemStatusCommand;
use App\Entity\Item;
use Doctrine\Common\Persistence\ObjectManager;

class UpdateItemStatusHandler
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function handle(UpdateItemStatusCommand $command)
    {
        $item = $command->getItem();
        $status = $command->getStatus();

        $item = $this->manager->getRepository(Item::class)->find($item->getId());

        $item->setStatus($status);

        $this->manager->flush();

        return $item;
    }
}