<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Establishment
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="establishment")
 */
class Establishment
{

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="string", length=9, nullable=false)
     */
    private $cif;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $city;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $zipCode;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phoneNumber;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mobilePhoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $web;

    /**
     * Establishment constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getCif(): string
    {
        return $this->cif;
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
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(string $email = null)
    {
        $this->email = $email;
    }

    /**
     * @return null|string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(string $address = null)
    {
        $this->address = $address;
    }

    /**
     * @return null|string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     */
    public function setCountry(string $country = null)
    {
        $this->country = $country;
    }

    /**
     * @return null|string
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param string|null $region
     */
    public function setRegion(string $region = null)
    {
        $this->region = $region;
    }

    /**
     * @return null|string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity(string $city = null)
    {
        $this->city = $city;
    }

    /**
     * @return int|null
     */
    public function getZipCode(): ?int
    {
        return $this->zipCode;
    }

    /**
     * @param int|null $zipCode
     */
    public function setZipCode(int $zipCode = null)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return int|null
     */
    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    /**
     * @param int|null $phoneNumber
     */
    public function setPhoneNumber(int $phoneNumber = null)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return int|null
     */
    public function getMobilePhoneNumber(): ?int
    {
        return $this->mobilePhoneNumber;
    }

    /**
     * @param int|null $mobilePhoneNumber
     */
    public function setMobilePhoneNumber(int $mobilePhoneNumber = null)
    {
        $this->mobilePhoneNumber = $mobilePhoneNumber;
    }

    /**
     * @return null|string
     */
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    /**
     * @param string|null $logo
     */
    public function setLogo(string $logo = null)
    {
        $this->logo = $logo;
    }

    /**
     * @return null|string
     */
    public function getWeb(): ?string
    {
        return $this->web;
    }

    /**
     * @param string|null $web
     */
    public function setWeb(string $web = null)
    {
        $this->web = $web;
    }

}