<?php

namespace App\Admin;


use App\Entity\Offer;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\CoreBundle\Form\Type\DatePickerType;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OfferAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextType::class)
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'descuento' => Offer::DISCOUNT,
                    'descuento combinado' => Offer::COMBINDED_DISCOUNT
                ]
            ])
            ->add('description', TextareaType::class)
            ->add('image', MediaType::class, [
                'provider' => 'sonata.media.provider.image',
                'context' => 'default',
                'new_on_update' => false,
            ])
            ->add('baseProduct', ModelType::class)
            ->add('baseProductQuantity', IntegerType::class)
            ->add('combinedProduct', ModelType::class, [
                'required' => false,
            ])
            ->add('combinedProductQuantity', IntegerType::class, [
                'required' => false,
            ])
            ->add('mode', ChoiceType::class, [
                'choices' => [
                    'nuevo precio' => Offer::NEW_PRICE,
                    'porcentaje de descuento' => Offer::DISCOUNT_PERCENTAGE,
                ]
            ])
            ->add('value', IntegerType::class)
            ->add('startingDate', DatePickerType::class, [
                'format' => 'yyyy-MM-dd',
            ])
            ->add('endingDate', DatePickerType::class, [
                'format' => 'yyyy-MM-dd',
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'habilitada' => Offer::ENABLED,
                    'caducada' => Offer::EXPIRED,
                    'deshabilitada' => Offer::DISABLED,
                ]
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('type')
            ->add('baseProduct')
            ->add('combinedProduct')
            ->add('mode')
            ->add('startingDate')
            ->add('status')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('type')
            ->add('baseProduct')
            ->add('baseProductQuantity')
            ->add('combinedProduct')
            ->add('combinedProductQuantity')
            ->add('mode')
            ->add('value')
            ->add('startingDate')
            ->add('endingDate')
            ->add('status')
        ;
    }

}