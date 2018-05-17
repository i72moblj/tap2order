<?php

namespace App\Form\DTO;


use App\Entity\Choice;
use App\Entity\Item;
use App\Entity\ItemChoice;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


class EditItem
{
    /**
     * @var Item
     */
    private $item;

    /**
     * @var integer
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

    /**
     * @var Collection
     */
    private $itemChoices;

    public function __construct(Item $item)
    {
        $this->choices = new ArrayCollection();
        $this->itemChoices = new ArrayCollection();
        $this->setItem($item);
        $this->quantity = $item->getQuantity();
        $this->setItemChoices($item->getItemChoices());
    }

    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * @param Item $item
     * @return EditItem
     */
    public function setItem(Item $item): EditItem
    {
        $this->item = $item;

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
     * @return EditItem
     */
    public function setQuantity(int $quantity): EditItem
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
     * @return EditItem
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
     * @param Collection $itemChoices
     * @return EditItem
     */
    public function setItemChoices(Collection $itemChoices): self
    {
        /** @var ItemChoice $itemChoice */
        foreach ($itemChoices as $itemChoice) {
            $this->choices[] = $itemChoice->getChoice();
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getItemChoices(): Collection
    {
        return $this->itemChoices;
    }

    /**
     * @param ItemChoice $itemChoice
     * @return EditItem;
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

    /**
     * @param ExecutionContextInterface $context
     * @param $payload
     *
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {
        $maxChoices = $this->getItem()->getProduct()->getMaxChoices();
        $minChoices = $this->getItem()->getProduct()->getMinChoices();
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