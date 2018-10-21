<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
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
    const OPEN= 'abierta';
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
    private $subtotal;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $discount;

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
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Item", mappedBy="order", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $items;

    /**
     * @var Offer
     *
     * @ORM\ManyToOne(targetEntity="Offer", inversedBy="orders")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true)
     */
    private $offer;

    /**
     * Order constructor.
     */
    public function __construct()
    {
        $this->subtotal = 0;
        $this->discount = 0;
        $this->total = 0;
        $this->createdAt = new \DateTime();
        $this->status = Order::OPEN;
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
     * @return Order
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return int
     */
    public function getSubtotal(): int
    {
        return $this->subtotal;
    }

    /**
     * @param int $subtotal
     * @return Order
     */
    public function setSubtotal(int $subtotal): self
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * @return int
     */
    public function getDiscount(): int
    {
        return $this->discount;
    }

    /**
     * @param int $discount
     * @return Order
     */
    public function setDiscount(int $discount): self
    {
        $this->discount = $discount;

        return $this;
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
     * @return Order
     */
    public function setTotal(int $total)
    {
        $this->total = $total;

        return $this;
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
     * @return Order
     */
    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
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
     * @return Order
     */
    public function setTag(Tag $tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @param Item $item
     * @return Order
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

    /**
     * @return Offer|null
     */
    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    /**
     * @param Offer $offer
     * @return Order
     */
    public function setOffer(Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }



}