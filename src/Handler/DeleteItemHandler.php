<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 17/05/18
 * Time: 0:34
 */

namespace App\Handler;


use App\Command\DeleteItemCommand;
use App\Entity\Item;
use Doctrine\Common\Persistence\ObjectManager;

class DeleteItemHandler
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function handle(DeleteItemCommand $command) {
        $id = $command->getId();

        $item = $this->manager->getRepository(Item::class)->find($id);

        $this->manager->remove($item);
        $this->manager->flush();
    }

}