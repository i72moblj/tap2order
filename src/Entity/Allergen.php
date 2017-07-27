<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Allergen
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="allergen")
 */
class Allergen
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
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $logo;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="allergens")
     */
    private $products;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Variety", mappedBy="allergens")
     */
    private $varieties;

    /**
     * Allergen constructor.
     * @param int $id
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->products = new ArrayCollection();
        $this->varieties = new ArrayCollection();
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
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    /**
     * @param Variety $variety
     */
    public function addVariety(Variety $variety)
    {
        $this->varieties[] = $variety;
    }

}