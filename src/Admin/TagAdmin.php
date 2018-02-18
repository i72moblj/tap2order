<?php

namespace App\Admin;

use App\Entity\Tag;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TagAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('idTag', TextType::class)
            ->add('name', TextType::class)
            ->add('location', TextType::class)
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'NFC' => Tag::NFC,
                    'QR' => Tag::QR,
                    'both' => Tag::BOTH,
                ],
            ])
            ->add('isEnabled', CheckboxType::class, [
                'required' => false
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('idTag')
            ->add('name')
            ->add('location')
            ->add('type')
            ->add('isEnabled')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('idTag')
            ->addIdentifier('name')
            ->addIdentifier('location')
            ->addIdentifier('type')
            ->addIdentifier('isEnabled')
        ;
    }
}