<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


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
     *
     * @Assert\NotBlank(message="No puedes dejar el cif en blanco")
     */
    private $cif;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128, nullable=false)
     *
     * @Assert\NotBlank(message="No puedes dejar el nombre en blanco")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128, nullable=true)
     *
     * @Assert\Email(
     *     message = "El email '{{ value }}' no es un email válido",
     *     checkMX = true
     * )
     * @Assert\Length(
     *      max = 128,
     *      maxMessage = "El email no puede ser mayor de {{ limit }} caracteres"
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128, nullable=true)
     *
     * @Assert\Length(
     *      max = 128,
     *      maxMessage = "La dirección no puede ser mayor de {{ limit }} caracteres"
     * )
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=true)
     *
     * @Assert\Length(
     *      max = 32,
     *      maxMessage = "El nombre del país no puede ser mayor de {{ limit }} caracteres"
     * )
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=true)
     *
     * @Assert\Length(
     *      max = 32,
     *      maxMessage = "El nombre de la región no puede ser mayor de {{ limit }} caracteres"
     * )
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=true)
     *
     * @Assert\Length(
     *      max = 32,
     *      maxMessage = "El nombre de la ciudad no puede ser mayor de {{ limit }} caracteres."
     * )
     */
    private $city;

    /**
     * @var integer
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Assert\Length(
     *     min = 5,
     *     max = 5,
     *     exactMessage = "El Código Postal debe tener exactamente {{ limit }} caracteres."
     * )
     *
     * Los números de Códigos Postales en España van del 01000 al 52999, los 2 primeros son el código de provincia
     * @Assert\Regex(
     *     pattern="/0[1-9][0-9]{3}|[1-4][0-9]{4}|5[0-2][0-9]{3}/",
     *     message="El Código Postal no es válido."
     * )
     */
    private $zipCode;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Assert\Length(
     *     min = 9,
     *     max = 9,
     *     exactMessage = "El número de teléfono fijo debe tener exactamente {{ limit }} caracteres."
     * )
     *
     * Los números de teléfono fijo en España tienen 9 cifras y la primera es un 8 ó 9.
     * @Assert\Regex(
     *     pattern="/^[8-9][0-9]{8}$/",
     *     message="El número de teléfono fijo no es válido."
     * )
     */
    private $phoneNumber;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Assert\Length(
     *     min = 9,
     *     max = 9,
     *     exactMessage = "El número de teléfono móvil debe tener exactamente {{ limit }} caracteres."
     * )
     *
     * Los números de teléfono móvil en España tienen 9 cifras y la primera es un 6 ó 7.
     * @Assert\Regex(
     *     pattern="/^[6-7][0-9]{8}$/",
     *     message="El número de teléfono móvil no es válido."
     * )
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
     *
     * @Assert\Url(
     *     message = "La url '{{ value }}' no es una url válida."
     * )
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
    public function __toString()
    {
        return $this->getCif() ?? '';
    }

    /**
     * @return string
     */
    public function getCif(): ?string
    {
        return $this->cif;
    }

    /**
     * @param string $cif
     */
    public function setCif(string $cif): void
    {
        $this->cif = $cif;
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
     * @return Establishment
     */
    public function setName(string $name = null)
    {
        $this->name = $name;

        return $this;
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
     * @return Establishment
     */
    public function setEmail(string $email = null)
    {
        $this->email = $email;

        return $this;
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
     * @return Establishment
     */
    public function setAddress(string $address = null)
    {
        $this->address = $address;

        return $this;
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
     * @return Establishment
     */
    public function setCountry(string $country = null)
    {
        $this->country = $country;

        return $this;
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
     * @return Establishment
     */
    public function setRegion(string $region = null)
    {
        $this->region = $region;

        return $this;
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
     * @return Establishment
     */
    public function setCity(string $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * @param string|null $zipCode
     */
    public function setZipCode(string $zipCode = null)
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
     * @return Establishment
     */
    public function setPhoneNumber(int $phoneNumber = null)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
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
     * @return Establishment
     */
    public function setMobilePhoneNumber(int $mobilePhoneNumber = null)
    {
        $this->mobilePhoneNumber = $mobilePhoneNumber;

        return $this;
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
     * @return Establishment
     */
    public function setLogo(string $logo = null)
    {
        $this->logo = $logo;

        return $this;
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
     * @return Establishment
     */
    public function setWeb(string $web = null)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * @param ExecutionContextInterface $context
     * @param $payload
     *
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {
        $error = false;

        $cif = $this->getCif();

        if (strlen($cif) < 9 || strlen($cif) > 9) {
            $error = "El cif debe tener exactamente 9 caracteres de largo";
        }
        else {
            $tipoOrganizacion = substr($cif, 0, 1);
            $codigoProvincia = substr($cif, 1, 2);
            $numeroRegistro = substr($cif, 3,5);
            $codigoControl = substr($cif, 8,1);

            $tipoOrganizacion = strtoupper($tipoOrganizacion);

            // Valores válidos
            $tiposOrganizacionesValidos = array("A", "B", "C", "D", "E", "F", "G", "H", "J", "N", "P", "Q", "R", "S", "U", "V", "W");
            $codigosProvinciaValidos = array("00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "46", "47", "48", "49", "50", "51", "52", "53", "54", "55", "56", "57", "58", "59", "60", "61", "62", "63", "64", "65", "66", "67", "68", "70", "71", "72", "73", "74", "75", "76", "77", "78", "79", "80", "81", "82", "83", "84", "85", "86", "87", "90", "91", "92", "93", "94", "95", "96", "97", "98", "99");

            // Comprobar tipo de Organizacion
            if(!in_array($tipoOrganizacion, $tiposOrganizacionesValidos)) {
                $error = "La letra correspondiente al tipo de organización no es válida.";
            }
            // Comprobar el codigo de la provincia
            elseif (!in_array($codigoProvincia, $codigosProvinciaValidos)) {
                $error = "El código de provincia no es válido.";
            }
            // Comprobar el número de registro es un número de 5 cifras
            elseif (!preg_match("/^[0-9]{5}$/", $numeroRegistro)) {
                $error = "El número de registro no es válido.";
            }
            // Comprobar el código de control
            else {
                // Si tipo de organización es P, Q, S, W tiene que ser una letra
                if (in_array($tipoOrganizacion, ["P", "Q", "S", "W"]) && !preg_match("/^[a-zA-Z]$/", $codigoControl)) {
                    $error = "El código de control debe ser una letra.";
                }
                // Si tipo de organización es A, B, E, H tiene que ser un número
                elseif (in_array($tipoOrganizacion, ["A", "B", "E", "H"]) && !preg_match("/^[0-9]$/", $codigoControl)) {
                    $error = "El código de control debe ser un número.";
                }
                // En cualquiera de los casos el dígito de control debe coincidir con un número o letra exacto
                else {
                    $numerosCentrales = $codigoProvincia . $numeroRegistro;

                    $sumaPares = (int) $numerosCentrales[1] + (int) $numerosCentrales[3] + (int) $numerosCentrales[5];

                    $sumaImpares = 0;
                    for ($i = 0; $i <= 7; $i = $i + 2) {
                        $resultado = (int) $numerosCentrales[$i] * 2;
                        if ($resultado >= 10) {
                            $sumaImpares = $sumaImpares + (1 + ($resultado % 10));
                        }
                        else {
                            $sumaImpares = $sumaImpares + $resultado;
                        }
                    }

                    $suma = $sumaPares + $sumaImpares;
                    $digitoUnidades = $suma % 10;
                    $digitoControlCalculado = 10 - $digitoUnidades;

                    switch ((int) $digitoControlCalculado) {
                        case 0:
                            $letra = "J";
                            break;
                        case 1:
                            $letra = "A";
                            break;
                        case 2:
                            $letra = "B";
                            break;
                        case 3:
                            $letra = "C";
                            break;
                        case 4:
                            $letra = "D";
                            break;
                        case 5:
                            $letra = "E";
                            break;
                        case 6:
                            $letra = "F";
                            break;
                        case 7:
                            $letra = "G";
                            break;
                        case 8:
                            $letra = "H";
                            break;
                        case 9:
                            $letra = "I";
                            break;
                    }

                    // Si tipo de organización es P, Q, S, W tiene que ser una letra y debe coincidir
                    if (in_array($tipoOrganizacion, ["P", "Q", "S", "W"]) && (strtoupper($codigoControl) !== $letra)) {
                        $error = "La letra del dígito de control no es válida.";
                    }
                    // Si tipo de organización es A, B, E, H tiene que ser un número y debe coincidir
                    elseif (in_array($tipoOrganizacion, ["A", "B", "E", "H"]) && ((int) $codigoControl !== (int) $digitoControlCalculado)) {
                        $error = "El número del dígito de control no es válido.";
                    }
                    // El resto puede ser número o letra. Si es número debe coincidir con el número y si es letra debe coincidir con la letra correspondiente al número
                    elseif (((int) $codigoControl !== (int) $digitoControlCalculado) && (strtoupper($codigoControl) !== $letra)) {
                        $error = "El código de control no es válido.";
                    }
                }
            }

        }

        if ($error) {
            $context->buildViolation('CIF no válido: ' . $error)
                ->atPath('cif')
                ->addViolation();
        }
    }

}