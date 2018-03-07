<?php

namespace App\Handler;


use App\Command\GetAllItemsByOrderQuery;
use App\Entity\Item;
use Doctrine\Common\Persistence\ObjectManager;

class GetAllItemsByOrderHandler
{
    private $repository;

    public function __construct(ObjectManager $manager)
    {
        $this->repository = $manager->getRepository(Item::class);
    }

    public function handle(GetAllItemsByOrderQuery $query)
    {
        $items = $this->repository->findBy([
            'order' => $query->getOrderId()
        ]);

        return $items;
    }
}