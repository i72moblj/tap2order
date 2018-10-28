<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 28/10/18
 * Time: 23:08
 */

namespace App\Command;


use App\Entity\Item;

class UpdateItemStatusCommand
{
    /**
     * @var Item $item
     */
    private $item;

    /**
     * @var string $status
     */
    private $status;

    public function __construct(Item $item, string $status)
    {
        $this->item = $item;
        $this->status = $status;
    }

    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

}