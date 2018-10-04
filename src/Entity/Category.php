<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Category
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category
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
     * @var Media|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Media", cascade={"all"})
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    protected $image;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isEnabled;

    /**
     * @Gedmo\Slug(fields={"name"}, unique=true)
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Subcategory", mappedBy="category", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $subcategories;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->isEnabled = true;
        $this->subcategories = new ArrayCollection();
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
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * @return Category
     */
    public function setImage(?Media $image): self
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
     * @return Category
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return ArrayCollection
     */
    public function getSubcategories()
    {
        return $this->subcategories;
    }

    /**
     * @param Subcategory $subcategory
     * @return Category
     */
    public function addSubcategory(Subcategory $subcategory)
    {
        $this->subcategories[] = $subcategory;

        return $this;
    }

    /**
     * @param Subcategory $subcategory
     */
    public function removeSubcategory(Subcategory $subcategory)
    {
        $this->subcategories->removeElement($subcategory);
    }
}