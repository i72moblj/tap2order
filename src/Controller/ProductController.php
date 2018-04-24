<?php

namespace App\Controller;


use App\Command\AddItemCommand;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Subcategory;
use App\Form\AddItemType;
use App\Form\DTO\AddItem;
use App\Services\GetTagOpenOrder;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends Controller
{
    /**
     * @var CommandBus
     */
    private $bus;

    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @Route("/menu/{categorySlug}/{subcategorySlug}/{productSlug}", name="product_show")
     * @ParamConverter("category", options={"mapping" : {"categorySlug": "slug"}})
     * @ParamConverter("subcategory", options={"mapping" : {"subcategorySlug": "slug"}})
     * @ParamConverter("product", options={"mapping" : {"productSlug": "slug"}})
     */
    public function show(Request $request, Category $category, Subcategory $subcategory, Product $product)
    {
        $addItem = new AddItem();
        $addItem->setProduct($product);

        $form = $this->createForm(AddItemType::class, $addItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->bus->handle(
                new AddItemCommand(
                    $this->get(GetTagOpenOrder::class)->getOrder($this->getUser()),
                    $product,
                    $form->get('quantity')->getData(),
                    $product->getPrice()
                )
            );

            return $this->redirectToRoute('homepage');
        }

        return $this->render('frontend/product/view.html.twig', [
            'form' => $form->createView(),
            'product' => $product,
        ]);
    }
}