<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Product
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{
    const VAT_REGULAR = 'normal';
    const VAT_REDUCED = 'reducido';
    const VAT_SUPERREDUCED = 'superreducido';

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
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=16, nullable=false)
     */
    private $vat;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $quantity;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isEnabled;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Subcategory", inversedBy="products")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $subcategory;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Choice", inversedBy="products")
     * @ORM\JoinTable(name="products_choices")
     */
    private $choices;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Allergen", inversedBy="products")
     * @ORM\JoinTable(name="products_allergens")
     */
    private $allergens;

    /**
     * @var int
     *
     * One Product has One Media.
     * @ORM\OneToOne(targetEntity="Media", cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $media;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->vat = Product::VAT_REDUCED;
        $this->quantity = 0;
        $this->isEnabled = true;
        $this->choices = new ArrayCollection();
        $this->allergens = new ArrayCollection();
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
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
    public function getVat(): string
    {
        return $this->vat;
    }

    /**
     * @param string $vat
     */
    public function setVat(string $vat)
    {
        $this->vat = $vat;
    }

    /**
     * @return null|string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }


    /**
     * @param string|null $image
     */
    public function setImage(string $image = null)
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * @param bool $isEnabled
     */
    public function setIsEnabled(bool $isEnabled)
    {
        $this->isEnabled = $isEnabled;
    }

    /**
     * @return int
     */
    public function getSubcategory(): int
    {
        return $this->subcategory;
    }

    /**
     * @param int $subcategory
     */
    public function setSubcategory(int $subcategory)
    {
        $this->subcategory = $subcategory;
    }

    /**
     * @return ArrayCollection
     */
    public function getChoices(): ArrayCollection
    {
        return $this->choices;
    }

    /**
     * @param Choice $choice
     * @return $this
     */
    public function addChoice(Choice $choice)
    {
        $this->choices[] = $choice;

        return $this;
    }

    /**
     * @param Choice $choice
     */
    public function removeChoice(Choice $choice)
    {
        $this->choices->removeElement($choice);
    }

    /**
     * @return ArrayCollection
     */
    public function getAllergens(): ArrayCollection
    {
        return $this->allergens;
    }

    /**
     * @param Allergen $allergen
     * @return $this
     */
    public function addAllergen(Allergen $allergen)
    {
        $this->allergens[] = $allergen;

        return $this;
    }

    /**
     * @param Allergen $allergen
     */
    public function removeAllergen(Allergen $allergen)
    {
        $this->allergens->removeElement($allergen);
    }

    /**
     * @return int
     */
    public function getMedia(): int
    {
        return $this->media;
    }

    /**
     * @param int $media
     */
    public function setMedia(int $media)
    {
        $this->media = $media;
    }
}