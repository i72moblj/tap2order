<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * Class Tag
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="tag")
 */
class Tag implements UserInterface, \Serializable
{
    const NFC = 'NFC';
    const QR = 'QR';
    const BOTH = 'ambos';

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64, nullable=false, unique=true)
     */
    private $idTag;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=16, nullable=false)
     */
    private $type;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isEnabled;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Order", mappedBy="tag")
     */
    private $orders;

    /**
     * Tag constructor.
     */
    public function __construct()
    {
        $this->isEnabled = true;
        $this->orders = new ArrayCollection();
        $this->idTag = Uuid::uuid4()->toString();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getIdTag() ?? '';
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
    public function getIdTag(): string
    {
        return $this->idTag;
    }

    /**
     * @param string $idTag
     * @return Tag
     */
    public function setIdTag(string $idTag)
    {
        $this->idTag = $idTag;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Tag
     */
    public function setName(string $name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string|null $location
     * @return Tag
     */
    public function setLocation(string $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Tag
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
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
     * @return Tag
     */
    public function setIsEnabled(bool $isEnabled)
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param Order $order
     * @return Tag
     */
    public function addOrder(Order $order)
    {
        $this->orders[] = $order;

        return $this;
    }

    /**
     * @param Order $order
     */
    public function removeOrder(Order $order)
    {
        $this->orders->removeElement($order);
    }

    /* Métodos para Symfony Guard */

    public function getUsername()
    {
        return $this->getIdTag();
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getPassword()
    {
    }

    public function getSalt()
    {
    }

    public function eraseCredentials()
    {
    }

    public function serialize()
    {
        return \serialize([
            $this->id,
            $this->idTag
        ]);
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->idTag
            ) = \unserialize($serialized);
    }


}