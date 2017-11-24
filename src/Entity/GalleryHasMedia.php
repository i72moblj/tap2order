<?php

namespace App\Entity;

use Sonata\MediaBundle\Entity\BaseGalleryHasMedia as BaseGalleryHasMedia;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class GalleryHasMedia
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="media__gallery_media")
 */
class GalleryHasMedia extends BaseGalleryHasMedia
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
