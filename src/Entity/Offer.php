<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Offer
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="offer")
 */
class Offer
{
    // Constantes de tipo de oferta
    const DISCOUNT = 'descuento';
    const COMBINDED_DISCOUNT = 'descuento combinado';

    // Constantes de modo de descuento
    const NEW_PRICE = 'nuevo precio';
    const DISCOUNT_PERCENTAGE = 'porcentaje de descuento';

    // Constantes de estado
    const ENABLED = 'habilitada';
    const EXPIRED = 'caducada';
    const DISABLED = 'deshabilitada';

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=false)
     */
    private $description;

    /**
     * @var Media|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Media", cascade={"all"})
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $image;

    /**
     * @var Product
     *
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="base_product_id", referencedColumnName="id", nullable=false)
     */
    private $baseProduct;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $baseProductQuantity;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="combined_product_id", referencedColumnName="id", nullable=true)
     */
    private $combinedProduct;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $combinedProductQuantity;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $mode;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $startingDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $endingDate;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $status;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Order", mappedBy="offer")
     */
    private $orders;

    /**
     * Offer constructor.
     */
    public function __construct()
    {
        $this->type = self::DISCOUNT;
        $this->mode = self::NEW_PRICE;
        $this->status = self::DISABLED;
        $this->orders = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName() ?? '';
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Offer
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Offer
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Media|null
     */
    public function getImage(): ?Media
    {
        return $this->image;
    }

    /**
     * @param Media|null $image
     * @return Offer
     */
    public function setImage(?Media $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Product|null
     */
    public function getBaseProduct(): ?Product
    {
        return $this->baseProduct;
    }

    /**
     * @param Product $baseProduct
     * @return Offer
     */
    public function setBaseProduct(Product $baseProduct): self
    {
        $this->baseProduct = $baseProduct;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getBaseProductQuantity(): ?int
    {
        return $this->baseProductQuantity;
    }

    /**
     * @param int $baseProductQuantity
     * @return Offer
     */
    public function setBaseProductQuantity(int $baseProductQuantity): self
    {
        $this->baseProductQuantity = $baseProductQuantity;

        return $this;
    }

    /**
     * @return Product|null
     */
    public function getCombinedProduct(): ?Product
    {
        return $this->combinedProduct;
    }

    /**
     * @param Product|null $combinedProduct
     * @return Offer
     */
    public function setCombinedProduct(?Product $combinedProduct): self
    {
        $this->combinedProduct = $combinedProduct;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCombinedProductQuantity(): ?int
    {
        return $this->combinedProductQuantity;
    }

    /**
     * @param int|null $combinedProductQuantity
     * @return Offer
     */
    public function setCombinedProductQuantity(?int $combinedProductQuantity): self
    {
        $this->combinedProductQuantity = $combinedProductQuantity;

        return $this;
    }

    /**
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * @param string $mode
     * @return Offer
     */
    public function setMode(string $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getValue(): ?int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return Offer
     */
    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getStartingDate(): ?\DateTime
    {
        return $this->startingDate;
    }

    /**
     * @param \DateTime $startingDate
     */
    public function setStartingDate(\DateTime $startingDate): void
    {
        $this->startingDate = $startingDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getEndingDate(): ?\DateTime
    {
        return $this->endingDate;
    }

    /**
     * @param \DateTime $endingDate
     * @return Offer
     */
    public function setEndingDate(\DateTime $endingDate): self
    {
        $this->endingDate = $endingDate;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Offer
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param Order $order
     * @return Offer
     */
    public function addOrder(Order $order): self
    {
        $this->orders[] = $order;

        return $this;
    }

    /**
     * @param Order $order
     * @return Offer
     */
    public function removeOrder(Order $order): self
    {
        $this->orders->removeElement($order);

        return $this;
    }

}