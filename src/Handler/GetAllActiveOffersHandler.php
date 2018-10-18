<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 18/10/18
 * Time: 13:01
 */

namespace App\Handler;


use App\Command\GetAllActiveOffersQuery;
use App\Entity\Offer;
use Doctrine\Common\Persistence\ObjectManager;

class GetAllActiveOffersHandler
{
    private $repository;

    public function __construct(ObjectManager $manager)
    {
        $this->repository = $manager->getRepository(Offer::class);
    }

    public function handle(GetAllActiveOffersQuery $query)
    {
        $offers = $this->repository->findBy([
            'status' => Offer::ENABLED,
        ]);

        return $offers;
    }
}