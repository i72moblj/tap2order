<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 22/10/18
 * Time: 0:17
 */

namespace App\Handler;


use App\Command\UpdateOrderDiscountCommand;
use App\Entity\Offer;
use App\Entity\Order;
use Doctrine\Common\Persistence\ObjectManager;

class UpdateOrderDiscountHandler
{
    /**
     * @var ObjectManager $manager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function handle(UpdateOrderDiscountCommand $command)
    {
        /** @var Order $order */
        $order = $command->getOrder();

        /** @var Offer $offer */
        $offer = $order->getOffer();

        if($offer === null) {
            $order->setDiscount(0);
        }
        else {






            // AQUI ES DONDE EL MEOLLO DE LAS OFERTAS
//            $discount = ...
//
//
//
//            $order->setDiscount($discount);
        }

        $this->manager->flush();

        return $order;
    }


}