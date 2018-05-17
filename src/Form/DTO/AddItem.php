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
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class AddItem
{
    /**
     * @var Product
     */
    private $product;

    /**
     * @var int
     *
     * @Assert\NotBlank(message="No puedes dejarlo en blanco")
     * @Assert\GreaterThanOrEqual(value="1", message="Seleccione mínimo 1")
     * @Assert\LessThanOrEqual(value="10", message="Seleccione máximo 10")
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

    /**
     * @param ExecutionContextInterface $context
     * @param $payload
     *
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {
        $maxChoices = $this->getProduct()->getMaxChoices();
        $minChoices = $this->getProduct()->getMinChoices();
        $numberChoices = $this->getChoices()->count();

        if ($numberChoices > $maxChoices) {
            $context->buildViolation('Número máximo de elecciones: ' . $maxChoices)
                ->atPath('choices')
                ->addViolation();
        }

        if ($numberChoices < $minChoices) {
            $context->buildViolation('Número mínimo de elecciones: ' . $minChoices)
                ->atPath('choices')
                ->addViolation();
        }

    }

}