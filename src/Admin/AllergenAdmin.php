<?php
/**
 * Created by PhpStorm.
 * User: i72moblj
 * Date: 13/09/17
 * Time: 11:40
 */

namespace App\Admin;


use App\Entity\Allergen;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class AllergenAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit form
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextType::class)
            ->add('logo', FileType::class, [
                'required' => false
            ])
            ->add('products', ModelType::class, [
                'by_reference' => false,
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('choices', ModelType::class, [
                'by_reference' => false,
                'multiple' => true
            ])
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('logo', FileType::class, ['sortable' => false])
            ->add('products', CollectionType::class)
            ->add('choices', CollectionType::class)
        ;
    }

    public function toString($object)
    {
        return $object instanceof Allergen
            ? $object->getName()
            : 'Allergen'; // shown in the breadcrumb on the create view
    }
}