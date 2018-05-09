<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Choice
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="choice")
 */
class Choice
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
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $supplement;

    /**
    * @var string
    *
    * @ORM\Column(type="string", length=128, nullable=true)
    */
    private $image;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isEnabled;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="choices")
     */
    private $products;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Allergen", inversedBy="choices")
     * @ORM\JoinTable(name="choices_allergens")
     */
    private $allergens;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ItemChoice", mappedBy="choice")
     */
    private $itemChoices;

    /**
     * Choice constructor.
     */
    public function __construct()
    {
        $this->supplement = 0;
        $this->isEnabled = true;
        $this->products = new ArrayCollection();
        $this->allergens = new ArrayCollection();
        $this->itemChoices = new ArrayCollection();
    }

    /**
     * @return string
     */
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
     * @return Choice
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * @return Choice
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return integer
     */
    public function getSupplement()
    {
        return $this->supplement;
    }

    /**
     * @param integer $supplement
     * @return Choice
     */
    public function setSupplement($supplement)
    {
        $this->supplement = $supplement;

        return $this;
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
     * @return Choice
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
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
     * @return Choice
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param Product $product
     * @return Choice
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
        $product->addChoice($this);

        return $this;
    }

    /**
     * @param Product $product
     */
    public function removeProduct(Product $product)
    {
        $this->products->removeElement($product);
        $product->removeChoice($this);
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
     * @return Choice
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
     * @return ArrayCollection
     */
    public function getItemChoices(): ArrayCollection
    {
        return $this->itemChoices;
    }

    /**
     * @param ItemChoice $itemChoice
     * @return Choice
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