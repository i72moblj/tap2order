<?php
/**
 * Created by PhpStorm.
 * User: jesules
 * Date: 30/05/18
 * Time: 1:56
 */

namespace App\Admin;


use App\Entity\Establishment;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class EstablishmentAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit form
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextType::class)
            ->add('cif', TextType::class)
            ->add('email', EmailType::class, [
                'required' => false
            ])
            ->add('address', TextType::class, [
                'required' => false
            ])
            ->add('country', TextType::class, [
                'required' => false
            ])
            ->add('region', TextType::class, [
                'required' => false
            ])
            ->add('city', TextType::class, [
                'required' => false
            ])
            ->add('zipCode', TextType::class, [
                'required' => false
            ])
            ->add('phoneNumber', IntegerType::class, [
                'required' => false
            ])
            ->add('mobilePhoneNumber', IntegerType::class, [
                'required' => false
            ])
            ->add('web', UrlType::class, [
                'required' => false
            ])
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('cif', TextType::class)
            ->add('email', EmailType::class)
            ->add('address', TextType::class)
            ->add('country', TextType::class)
            ->add('region', TextType::class)
            ->add('city', TextType::class)
            ->add('zipCode', TextType::class)
            ->add('phoneNumber', TelType::class)
            ->add('mobilePhoneNumber', TelType::class)
            ->add('web', UrlType::class)
        ;
    }

    public function toString($object)
    {
        return $object instanceof Establishment
            ? $object->getName()
            : 'Establishment'; // shown in the breadcrumb on the create view
    }
}