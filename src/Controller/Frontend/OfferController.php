<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 18/10/18
 * Time: 12:55
 */

namespace App\Controller\Frontend;


use App\Command\GetAllActiveOffersQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class OfferController extends Controller
{
    /**
     * @Route("/ofertas", name="offer_index")
     */
    public function index()
    {
        $offers = $this->get('tactician.commandbus')->handle(
            new GetAllActiveOffersQuery()
        );

        return $this->render('frontend/offer/index.html.twig', [
            'offers' => $offers,
        ]);
    }

}