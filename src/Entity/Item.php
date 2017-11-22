<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Item
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="item")
 */
class Item
{
    /**
     * @var number
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $quantity;


    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $status;

    /**
     * Item constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return number
     */
    public function getId(): number
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }


}