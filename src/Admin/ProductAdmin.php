<?php

namespace App\Admin;

use App\Entity\Product;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sonata\AdminBundle\Form\Type\ModelType;

class ProductAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit form
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextType::class)
            ->add('subcategory', ModelType::class, [
                'label' => 'Subcategory',
            ])
            ->add('description', TextareaType::class)
            ->add('price', MoneyType::class, [
                'divisor' => 100,
            ])
            ->add('vat', ChoiceType::class, [
                'choices' => [
                    'Normal' => Product::VAT_REGULAR,
                    'Reducido' => Product::VAT_REDUCED,
                    'Superreducido' => Product::VAT_SUPERREDUCED,
                ],
            ])
            ->add('image', MediaType::class, [
                'provider' => 'sonata.media.provider.image',
                'context' => 'default',
                'new_on_update' => false,
                'required' => false,
            ])
            ->add('minChoices', IntegerType::class, [
                'attr' => [
                    'min' => 0,
                ]
            ])
            ->add('maxChoices', IntegerType::class, [
                'attr' => [
                    'min' => 0,
                ]
            ])
            ->add('choices', ModelType::class, [
                'multiple' => true
            ])
            ->add('allergens', ModelType::class, [
                'multiple' => true
            ])
            ->add('isEnabled', CheckboxType::class, [
                'required' => false,
            ])
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('vat')
            ->add('subcategory')
            ->add('isEnabled')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('subcategory', ModelType::class, [
                'sortable' => true,
                'sort_field_mapping'=> ['fieldName'=>'name'],
                'sort_parent_association_mappings' => [['fieldName'=>'subcategory']]
            ])
            ->add('description', TextareaType::class, ['sortable' => false])
            ->add('price', TextType::class, [
                'template' => 'backend/product/list_price.html.twig'
            ])
            ->add('vat')
            ->add('image', FileType::class, ['sortable' => false])
            ->add('minChoices')
            ->add('maxChoices')
            ->add('choices', CollectionType::class)
            ->add('allergens', CollectionType::class)
            ->add('isEnabled')
        ;
    }

    public function toString($object)
    {
        return $object instanceof Product
            ? $object->getName()
            : 'Product'; // shown in the breadcrumb on the create view
    }
}