<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 16/05/18
 * Time: 20:06
 */

namespace App\Command;


use App\Entity\ItemChoice;

class DeleteItemChoiceCommand
{
    /**
     * @var ItemChoice
     */
    private $itemChoice;

    /**
     * RemoveItemChoicesByItemCommand constructor.
     * @param ItemChoice $itemChoice
     */
    public function __construct(ItemChoice $itemChoice)
    {
        $this->itemChoice = $itemChoice;
    }

    /**
     * @return ItemChoice
     */
    public function getItemChoice(): ItemChoice
    {
        return $this->itemChoice;
    }
}