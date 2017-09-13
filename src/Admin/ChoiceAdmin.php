<?php

namespace App\Admin;

use App\Entity\Choice;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class ChoiceAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit form
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('supplement', MoneyType::class, [
                'divisor' => 100,
            ])
            ->add('image', FileType::class, [
                'required' => false
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
            ->add('supplement', TextType::class, [
                'template' => 'backend/choice/list_supplement.html.twig'
            ])
            ->add('image', FileType::class, ['sortable' => false])
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