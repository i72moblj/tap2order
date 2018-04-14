<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

// El nombre de la tabla usa backtick (`) porque order es una palabra reservada de MariaDB.
/**
 * Class Order
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="`order`")
 */
class Order
{
    const ACTIVE = 'activa';
    const SERVED = 'servida';

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $total;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $status;

    /**
     * @var Tag
     *
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="orders")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     */
    private $tag;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Item", mappedBy="order", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $items;

    /**
     * Order constructor.
     */
    public function __construct()
    {
        $this->status = Order::ACTIVE;
        $this->items = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal(int $total)
    {
        $this->total = $total;
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
     * @return Tag
     */
    public function getTag(): Tag
    {
        return $this->tag;
    }

    /**
     * @param Tag $tag
     */
    public function setTag(Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return ArrayCollection
     */
    public function getItems(): ArrayCollection
    {
        return $this->items;
    }

    /**
     * @param Item $item
     * @return $this
     */
    public function addItem(Item $item)
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @param Item $item
     */
    public function removeItem(Item $item)
    {
        $this->items->removeElement($item);
    }

}