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
     * Choice constructor.
     */
    public function __construct()
    {
        $this->supplement = 0;
        $this->isEnabled = true;
        $this->products = new ArrayCollection();
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
     * @return integer
     */
    public function getSupplement(): int
    {
        return $this->supplement;
    }

    /**
     * @param integer $supplement
     */
    public function setSupplement(int $supplement)
    {
        $this->supplement = $supplement;
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
     * @return ArrayCollection
     */
    public function getProducts(): ArrayCollection
    {
        return $this->products;
    }

    /**
     * @param Product $product
     * @return $this
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