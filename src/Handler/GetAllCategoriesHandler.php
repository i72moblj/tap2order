<?php

namespace App\Handler;


use App\Command\GetAllCategoriesQuery;
use App\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;

class GetAllCategoriesHandler
{
    private $repository;

    public function __construct(ObjectManager $manager)
    {
        $this->repository = $manager->getRepository(Category::class);
    }

    public function handle(GetAllCategoriesQuery $query)
    {
        $categories = $this->repository->findAll();

        return $categories;
    }
}