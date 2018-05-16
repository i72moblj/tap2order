<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 17/05/18
 * Time: 0:33
 */

namespace App\Command;


class DeleteItemCommand
{
    /**
     * @var int
     */
    private $id;

    /**
     * DeleteItemCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}