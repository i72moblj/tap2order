<?php

namespace App\Handler;


use App\Command\GetAllOpenOrdersQuery;
use App\Entity\Order;
use Doctrine\Common\Persistence\ObjectManager;

class GetAllOpenOrdersHandler
{
    private $repository;

    public function __construct(ObjectManager $manager)
    {
        $this->repository = $manager->getRepository(Order::class);
    }

    public function handle(GetAllOpenOrdersQuery $query) {
        $orders = $this->repository->findBy([
            'status' => 'activa'
        ]);

        return $orders;
    }
}