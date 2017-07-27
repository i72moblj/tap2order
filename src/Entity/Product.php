<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Product
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="entity")
 */
class Product
{
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
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, nullable=false)
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
     * @ORM\ManyToMany(targetEntity="Variety", inversedBy="products")
     * @ORM\JoinTable(name="products_varieties")
     */
    private $varieties;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Allergen", inversedBy="products")
     * @ORM\JoinTable(name="products_allergens")
     */
    private $allergens;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->vat = "reducido";
        $this->quantity = 0;
        $this->isEnabled = true;
        $this->varieties = new ArrayCollection();
        $this->allergens = new ArrayCollection();
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
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
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
     * @param Variety $variety
     */
    public function addVariety(Variety $variety)
    {
        $variety->addProduct($this);
        $this->varieties = $variety;
    }

    public function addAllergen(Allergen $allergen)
    {
        $allergen->addProduct($this);
        $this->allergens[] = $allergen;
    }

}