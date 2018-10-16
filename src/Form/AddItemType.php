<?php

namespace App\Form;

use App\Entity\Choice;
use App\Entity\Product;
use App\Form\DTO\AddItem;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $data = $builder->getData();
        /** @var Product $product */
        $product = $data->getProduct();

        $builder
            ->add('choices', EntityType::class, [
                'label' => 'Personaliza tu pedido:',
                'class' => Choice::class,
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (EntityRepository $repository) use ($product) {
                    return $repository
                        ->createQueryBuilder('c')
                        ->leftJoin('c.products', 'p')
                        ->where('p.id = :product AND c.isEnabled = :isEnabled')
                        ->setParameter('product', $product->getId())
                        ->setParameter('isEnabled', true)
                        ;
                },
            ])
            ->add('quantity', ChoiceType::class, [
                'label' => 'Cantidad:',
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                    '10' => 10,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddItem::class,
        ]);
    }
}