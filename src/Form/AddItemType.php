<?php

namespace App\Form;

use App\Entity\Choice;
use App\Entity\Product;
use App\Form\DTO\AddItem;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
                'label' => 'Elección:',
                'class' => Choice::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => function ($choice) {
                    $numero = $choice->getAllergens()->count();
                    $allergens = '';
                    foreach ($choice->getAllergens() as $allergen) {
                        $allergens = $allergens . ', ' . $allergen;
                    }
                    return $choice->getId() . ' ' . $choice->getName() . $numero . ' Alérgenos: ' . trim($allergens,',' . ' +' . $choice->getPrice());
                },
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
