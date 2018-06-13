<?php

namespace App\Controller\Frontend;


use App\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Command\GetAllSubcategoriesByCategoryQuery;


class SubcategoryController extends Controller
{
    /**
     * @Route("/menu/{categorySlug}", name="subcategory_index")
     * @ParamConverter("category", options={"mapping": {"categorySlug": "slug"}})
     * @param Category $category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Category $category)
    {
        $subcategories = $this->get('tactician.commandbus')->handle(
            new GetAllSubcategoriesByCategoryQuery($category->getId())
        );

        return $this->render('frontend/subcategory/index.html.twig', [
            'categorySlug' => $category->getSlug(),
            'subcategories' => $subcategories,
        ]);
    }

}