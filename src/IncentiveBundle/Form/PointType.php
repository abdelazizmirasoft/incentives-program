<?php

namespace IncentiveBundle\Form;

use IncentiveBundle\Entity\Type\ActionTypeEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PointType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'source',
                ChoiceType::class,
                [
                'required' => false,
                'label' => 'Source',
                'choices' => [
                    'DELIVERY' => ActionTypeEnum::DELIVERY ,
                    'RIDESHARE' => ActionTypeEnum::RIDE_SHARE ,
                    'RENT' => ActionTypeEnum::RENT ,
                ],
            ]
            )
            ;
    }
}
