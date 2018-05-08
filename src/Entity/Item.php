<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Item
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="item")
 */
class Item
{
    const ACTIVE = 'activo';
    const SERVED = 'servido';

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
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $status;

    /**
     * @var Order
     *
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="items")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $order;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="items")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     */
    private $product;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="ItemChoice", mappedBy="item", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $itemChoices;

    /**
     * Item constructor.
     */
    public function __construct()
    {
        $this->status = Item::ACTIVE;
        $this->itemChoices = new ArrayCollection();
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
     *
     * @return Item
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
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
     *
     * @return Item
     */
    public function setPrice(int $price)
    {
        $this->price = $price;

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
     *
     * @return Item
     */
    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @param Order $order
     *
     * @return Item
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     *
     * @return Item
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getItemChoices(): Collection
    {
        return $this->itemChoices;
    }

    /**
     * @param ItemChoice $itemChoice
     *
     * @return Item
     */
    public function addItemChoice(ItemChoice $itemChoice)
    {
        $this->itemChoices[] = $itemChoice;

        return $this;
    }

    /**
     * @param ItemChoice $itemChoice
     */
    public function removeItemChoice(ItemChoice $itemChoice)
    {
        $this->itemChoices->removeElement($itemChoice);
    }

}