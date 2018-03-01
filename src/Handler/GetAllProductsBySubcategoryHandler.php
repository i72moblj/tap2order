<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 18/01/18
 * Time: 18:17
 */

namespace App\Handler;


use App\Command\GetAllProductsBySubcategoryQuery;
use App\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;

class GetAllProductsBySubcategoryHandler
{
    private $repository;

    public function __construct(ObjectManager $manager)
    {
        $this->repository = $manager->getRepository(Product::class);
    }

    public function handle(GetAllProductsBySubcategoryQuery $query)
    {
        $products = $this->repository->findBy([
            'subcategory' => $query->getSubcategoryId()
        ]);

        return $products;
    }
}