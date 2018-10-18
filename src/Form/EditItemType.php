<?php

namespace App\Form;

use App\Entity\Choice;
use App\Entity\Item;
use App\Entity\Product;
use App\Form\DTO\EditItem;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $data = $builder->getData();
        /** @var Item $item */
        $item = $data->getItem();
        /** @var Product $product */
        $product = $item->getProduct();

        $builder
            ->add('quantity', ChoiceType::class, [
                'label' => 'Cantidad: ',
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
            ->add('choices', EntityType::class, [
                'label' => 'Elección',
                'class' => Choice::class,
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (EntityRepository $repository) use ($product) {
                    return $repository
                        ->createQueryBuilder('c')
                        ->leftJoin('c.products', 'p')
                        ->where('p.id = :product AND c.isEnabled = :isEnabled')
                        ->orderBy('c.name', 'ASC')
                        ->setParameter('product', $product->getId())
                        ->setParameter('isEnabled', true)
                        ;
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EditItem::class,
        ]);
    }
}
