<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ProfileType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\NotNull(),
                ],
            ])
            ->add('lastName', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\NotNull(),
                ],
            ])
            ->add('age', IntegerType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\NotNull(),
                    new Assert\GreaterThan(value: 16, groups: ['registration', 'edit_profile'])
                ],
            ])
            ->add('phone', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(groups: ['registration', 'edit_profile']),
                    new Assert\NotNull(groups: ['registration', 'edit_profile']),
                    new Assert\Regex(groups: ['registration'], pattern: '/^(0|\+212)(6|7)\d{2}(\-\d{2}){3}$/') // Moroccan Phone pattern only
                ],
            ]);
    }
}