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
     * One Product has One Media.
     * @ORM\OneToOne(targetEntity="Media", cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $media;

    /**
     * @return mixed
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param mixed $media
     */
    public function setMedia($media)
    {
        $this->media = $media;
    }

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

    public function __toString()
    {
        return $this->getName() ?? '';
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param integer $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * @param string $vat
     */
    public function setVat($vat)
    {
        $this->vat = $vat;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * @param bool $isEnabled
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;
    }

    /**
     * @return int
     */
    public function getSubcategory()
    {
        return $this->subcategory;
    }

    /**
     * @param int $subcategory
     */
    public function setSubcategory($subcategory)
    {
        $this->subcategory = $subcategory;
    }

    /**
     * @return ArrayCollection
     */
    public function getChoices()
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
    public function getAllergens()
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
}