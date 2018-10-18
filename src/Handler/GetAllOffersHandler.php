<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 18/10/18
 * Time: 13:01
 */

namespace App\Handler;


use App\Command\GetAllOffersQuery;
use App\Entity\Offer;
use Doctrine\Common\Persistence\ObjectManager;

class GetAllOffersHandler
{
    private $repository;

    public function __construct(ObjectManager $manager)
    {
        $this->repository = $manager->getRepository(Offer::class);
    }

    public function handle(GetAllOffersQuery $query)
    {
        $offers = $this->repository->findAll();

        return $offers;
    }
}