<?php

namespace App\Handler;


use App\Command\GetAllSubcategoriesByCategoryQuery;
use App\Entity\Subcategory;
use Doctrine\Common\Persistence\ObjectManager;

class GetAllSubcategoriesByCategoryHandler
{
    private $repository;

    public function __construct(ObjectManager $manager)
    {
        $this->repository = $manager->getRepository(Subcategory::class);
    }

    public function handle(GetAllSubcategoriesByCategoryQuery $query)
    {
        $subcategories = $this->repository->findBy(array(
            'category' => $query->getCategoryId()
        ));

        return $subcategories;
    }
}