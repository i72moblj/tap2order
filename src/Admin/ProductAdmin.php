<?php

namespace App\Admin;

use App\Entity\Product;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('image', FileType::class, [
                'required' => false
            ])
            ->add('quantity', IntegerType::class, [
                'attr' => [
                    'min' => 0,
                ]
            ])
            ->add('subcategory', ModelType::class, [
                'label' => 'Subcategory',
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
            ->add('description', TextareaType::class, ['sortable' => false])
            ->add('price')
            ->add('vat')
            ->add('image', FileType::class, ['sortable' => false])
            ->add('quantity')
            ->add('subcategory', EntityType::class, [
                'sortable' => true,
                'sort_field_mapping'=> ['fieldName'=>'name'],
                'sort_parent_association_mappings' => [['fieldName'=>'subcategory']]
            ])
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