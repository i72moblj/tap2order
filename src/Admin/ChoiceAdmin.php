<?php

namespace App\Admin;

use App\Entity\Choice;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class ChoiceAdmin extends AbstractAdmin
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
            ->add('image', MediaType::class, [
                'provider' => 'sonata.media.provider.image',
                'context' => 'default',
                'new_on_update' => false,
                'required' => false,
            ])
            ->add('products', ModelType::class, [
                'by_reference' => false,
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('allergens', ModelType::class, [
                'by_reference' => false,
                'expanded' => true,
                'multiple' => true,
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
            ->add('isEnabled')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description', TextareaType::class, ['sortable' => false])
            ->add('price', TextType::class, [
                'template' => 'backend/choice/list_price.html.twig'
            ])
            ->add('image', MediaType::class, ['sortable' => false])
            ->add('products', ModelType::class)
            ->add('allergens', ModelType::class)
            ->add('isEnabled')
        ;
    }

    public function toString($object)
    {
        return $object instanceof Choice
            ? $object->getName()
            : 'Product'; // shown in the breadcrumb on the create view
    }
}