<?php

namespace App\Controller\Frontend;


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
use App\Command\GetAllProductsBySubcategoryQuery;

/**
 * @Route("/menu")
 */
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
     * @Route("/{categorySlug}/{subcategorySlug}", name="product_index")
     * @ParamConverter("category", options={"mapping": {"categorySlug": "slug"}})
     * @ParamConverter("subcategory", options={"mapping": {"subcategorySlug": "slug"}})
     * @param Category $category
     * @param Subcategory $subcategory
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Category $category, Subcategory $subcategory) {
        $products = $this->get('tactician.commandbus')->handle(
            new GetAllProductsBySubcategoryQuery($subcategory->getId())
        );

        return $this->render('frontend/product/index.html.twig', [
            'category' => $category,
            'subcategory' => $subcategory,
            'products' => $products,
        ]);
    }

    /**
     * @Route("/{categorySlug}/{subcategorySlug}/{productSlug}", name="product_show")
     * @ParamConverter("category", options={"mapping" : {"categorySlug": "slug"}})
     * @ParamConverter("subcategory", options={"mapping" : {"subcategorySlug": "slug"}})
     * @ParamConverter("product", options={"mapping" : {"productSlug": "slug"}})
     * @param Request $request
     * @param Category $category
     * @param Subcategory $subcategory
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
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

            $this->addFlash(
                'success',
                'El artículo ha sido añadido al pedido.'
            );

            return $this->redirectToRoute('category_index');
        }

        return $this->render('frontend/product/show.html.twig', [
            'form' => $form->createView(),
            'category' => $category,
            'subcategory' => $subcategory,
            'product' => $product,
        ]);
    }
}