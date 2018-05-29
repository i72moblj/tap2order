<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 16/05/18
 * Time: 20:11
 */

namespace App\Handler;


use App\Command\DeleteItemChoiceCommand;
use App\Entity\ItemChoice;
use Doctrine\Common\Persistence\ObjectManager;

class DeleteItemChoiceHandler
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function handle(DeleteItemChoiceCommand $command)
    {
        $id = $command->getItemChoice()->getId();

        $itemChoice = $this->manager->getRepository(ItemChoice::class)->find($id);

        $this->manager->remove($itemChoice);
        $this->manager->flush();
    }

}