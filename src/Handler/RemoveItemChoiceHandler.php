<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 16/05/18
 * Time: 20:11
 */

namespace App\Handler;


use App\Command\RemoveItemChoiceCommand;
use App\Entity\ItemChoice;
use Doctrine\Common\Persistence\ObjectManager;

class RemoveItemChoiceHandler
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function handle(RemoveItemChoiceCommand $command)
    {
        $id = $command->getItemChoice()->getId();

        $itemChoice = $this->manager->getRepository(ItemChoice::class)->find($id);

        $this->manager->remove($itemChoice);
        $this->manager->flush();
    }

}