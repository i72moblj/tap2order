<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use App\Entity\Subcategory;

class SubcategoryAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit form
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextType::class)
            ->add('category', ModelType::class, [
                'label' => 'Category',
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
            ->add('category')
            ->add('isEnabled')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('category', EntityType::class, [
                'sortable' => true,
                'sort_field_mapping'=> ['fieldName'=>'name'],
                'sort_parent_association_mappings' => [['fieldName'=>'category']]
            ])
            ->add('isEnabled')
        ;
    }

    public function toString($object)
    {
        return $object instanceof Subcategory
            ? $object->getName()
            : 'Subcategory'; // shown in the breadcrumb on the create view
    }
}