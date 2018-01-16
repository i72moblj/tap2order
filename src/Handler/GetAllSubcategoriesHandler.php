<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 16/01/18
 * Time: 21:59
 */

namespace App\Handler;


use App\Command\GetAllSubcategoriesQuery;
use App\Entity\Subcategory;
use Doctrine\Common\Persistence\ObjectManager;

class GetAllSubcategoriesHandler
{
    private $repository;

    public function __construct(ObjectManager $manager)
    {
        $this->repository = $manager->getRepository(Subcategory::class);
    }

    public function handle(GetAllSubcategoriesQuery $query)
    {
        $subcategories = $this->repository->findBy(array(
            'category' => $query->getCategoryId()
        ));

        return $subcategories;
    }
}