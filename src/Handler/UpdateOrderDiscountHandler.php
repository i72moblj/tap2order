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
            $offerType = $order->getOffer()->getType();

            // Calcular el número de artículos que son del producto base
            $items = $order->getItems();

            $orderBaseProductQuantity = 0;
            foreach ($items as $item)
            {
                if ($item->getProduct() === $offer->getBaseProduct()) {
                    $orderBaseProductQuantity = $orderBaseProductQuantity + $item->getQuantity();
                }
            }

            // TIPO = DESCUENTO
            if ($offerType === Offer::DISCOUNT) {

                // MODO = NUEVO PRECIO
                if ($offer->getMode() === Offer::NEW_PRICE) {
                    $discount = ($offer->getBaseProduct()->getPrice() - $offer->getValue()) * $orderBaseProductQuantity;
                }
                // MODO = PORCENTAJE DE DESCUENTO
                else {
                    $discount = ($offer->getBaseProduct()->getPrice() * $offer->getValue() / 100) * $orderBaseProductQuantity;

                }
            }
            // TIPO = DESCUENTO COMBINADO
            else {
                // Producto base = Producto combinado
                if ($offer->getBaseProduct() === $offer->getCombinedProduct()) {
                    $offersQuantity = intdiv($orderBaseProductQuantity, $offer->getBaseProductQuantity());

                    $discount = ($offer->getBaseProduct()->getPrice() * $offer->getBaseProductQuantity()) - $offer->getValue();
                }
                // Producto base != Producto combinado
                else {
                    // Calcular el número de ofertas que se cumplen
                    $orderCombinedProductQuantity = 0;
                    foreach ($items as $item)
                    {
                        if ($item->getProduct() === $offer->getCombinedProduct()) {
                            $orderCombinedProductQuantity = $orderCombinedProductQuantity + $item->getQuantity();
                        }
                    }

                    $offersQuantity = min($orderBaseProductQuantity, $orderCombinedProductQuantity);

                    // MODO = NUEVO PRECIO
                    if ($offer->getMode() === Offer::NEW_PRICE) {
                        $discount = ($offer->getBaseProduct()->getPrice() + $offer->getCombinedProduct()->getPrice() - $offer->getValue()) * $offersQuantity;
                    }
                    // MODO = PORCENTAJE DE DESCUENTO
                    else {
                        $discount = ($offer->getBaseProduct()->getPrice() + $offer->getCombinedProduct()->getPrice()) * $offer->getValue() / 100 * $offersQuantity;
                    }
                }
            }










            $order->setDiscount($discount);
        }

        $this->manager->flush();

        return $order;
    }


}