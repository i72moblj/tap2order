<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 19/04/18
 * Time: 13:34
 */

namespace App\Form\DTO;


use App\Entity\Choice;
use App\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

class AddItem
{
    /**
     * @var Product
     */
    private $product;

    /**
     * @var int
     * @Assert\GreaterThan(value="0", message="Seleccione mínimo 1")
     */
    private $quantity;

    /**
     * @var Collection
     */
    private $choices;

    public function __construct()
    {
        $this->choices = new ArrayCollection();
        $this->quantity = 0;
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
     * @return AddItem
     */
    public function setProduct(Product $product): AddItem
    {
        $this->product = $product;
        return $this;
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
     * @return AddItem
     */
    public function setQuantity(int $quantity): AddItem
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getChoices(): Collection
    {
        return $this->choices;
    }

    /**
     * @param Choice $choice
     * @return AddItem
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

}