<?php

namespace App\Entity;

use Sonata\MediaBundle\Entity\BaseMedia;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Media
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="media__media")
 */
class Media extends BaseMedia
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
