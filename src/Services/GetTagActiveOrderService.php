<?php

namespace App\Services;


use App\Entity\Order;
use App\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class getTagOpenOrder
 * @package App\Service
 */
class GetTagActiveOrderService
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
            'status' => Order::ACTIVE,
            'tag' => $tag->getId(),
        ]);

        if ($order === null) {
            $order = new Order();
            $order->setTag($tag);
            $this->manager->persist($order);
            $this->manager->flush();
        }

        return $order;
    }
}