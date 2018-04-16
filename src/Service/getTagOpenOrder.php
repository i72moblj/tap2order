<?php

namespace App\Service;


use App\Entity\Order;
use App\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class getTagOpenOrder
 * @package App\Service
 */
class getTagOpenOrder
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * getTagOpenOrder constructor.
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Tag $tag
     * @return Order
     */
    public function getOrder(Tag $tag): Order
    {
        $repository = $this->manager->getRepository(Order::class);
        $order = $repository->findOneBy([
            'status' => Order::ACTIVE
        ]);

        if ($order === null) {
            $order = new Order();
            $order->setCreatedAt(new \DateTime());
            $order->setTotal(0);
            $order->setTag($tag);
            $this->manager->persist($order);
            $this->manager->flush();
        }

        return $order;
    }
}