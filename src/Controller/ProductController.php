<?php

namespace App\Controller;


use App\Command\AddItemChoiceCommand;
use App\Command\AddItemToOrderCommand;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Subcategory;
use App\Form\AddItemType;
use App\Form\DTO\AddItem;
use App\Services\GetTagOpenOrderService;
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

    /**
     * @var GetTagOpenOrderService
     */
    private $getTagOpenOrder;

    public function __construct(CommandBus $bus, GetTagOpenOrderService $getTagOpenOrder)
    {
        $this->bus = $bus;
        $this->getTagOpenOrder = $getTagOpenOrder;
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
            $tag = $this->getUser();
            $order = $this->getTagOpenOrder->getOrder($tag);

            $item = $this->bus->handle(
                new AddItemToOrderCommand(
                    $order,
                    $addItem
                )
            );

//            $choices = $form->get('choices')->getData();
//            foreach ($choices as $choice) {
//                $this->bus->handle(
//                    new AddItemChoiceCommand(
//                        $item,
//                        $choice
//                    )
//                );
//            }

            return $this->redirectToRoute('homepage');
        }

        return $this->render('frontend/product/view.html.twig', [
            'form' => $form->createView(),
            'product' => $product,
        ]);
    }
}