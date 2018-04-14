<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class ItemChoice
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="itemChoice")
 */
class ItemChoice
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var integer
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $status;

    /**
     * @var Item
     *
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="itemChoices")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $item;

    /**
     * @var Choice
     *
     * @ORM\ManyToOne(targetEntity="Choice", inversedBy="itemChoices")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     */
    private $choice;

    /**
     * ItemChoice constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price)
    {
        $this->price = $price;
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

    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * @param Item $item
     */
    public function setItem(Item $item)
    {
        $this->item = $item;
    }

    /**
     * @return Choice
     */
    public function getChoice(): Choice
    {
        return $this->choice;
    }

    /**
     * @param Choice $choice
     */
    public function setChoice(Choice $choice)
    {
        $this->choice = $choice;
    }

}