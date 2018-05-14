<?php

namespace App\Form;

use App\Entity\Choice;
use App\Entity\Product;
use App\Form\DTO\EditItem;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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










// CONSULTA:

// select c.name from choice c left join itemChoice i on c.id = i.item_id where i.item_id = 1;

// Sustituir el 1 por $item->getId();






        $builder
            ->add('quantity', NumberType::class, [
                'label' => 'Cantidad',
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
//                'data' => $itemChoices,



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
