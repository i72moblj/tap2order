<?php

namespace App\Entity;

use Sonata\MediaBundle\Entity\BaseGallery as BaseGallery;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Gallery
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="media__gallery")
 */
class Gallery extends BaseGallery
{
    /**
     * @var int $id
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
}
