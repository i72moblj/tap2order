<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Tag
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="tag")
 */
class Tag
{
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
     * Tag constructor.
     */
    public function __construct()
    {
        $this->isEnabled = true;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     */
    public function setName(string $name = null)
    {
        $this->name = $name;
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
     */
    public function setLocation(string $location = null)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
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
}