<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\DTO\Blog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('title', TextType::class, [
            'label' => "Blog's title",
            'attr' => [
                'placeholder' => 'Ipsum lorem dolore...',
            ],
            'help' => 'This title will be displayed in the home page. So it needs to be as clear as possible.',
            'constraints' => [
                new Assert\NotBlank(message: 'Ce champ ne peut pas être vide.'),
                new Assert\NotNull(message: 'Ce champ est obligatoire.')
            ],
        ])
            ->add('content', TextareaType::class, [
                'label' => "Blog content",
                'attr' => [
                    'rows' => 10,
                    'placeholder' => 'You can set any content here...',
                ],
                'help' => 'Le contenu du blog ne doit pas dépasser 200 caractères',
                'constraints' => [
                    new Assert\Length(max: 200, maxMessage: 'Ce contenu dépasse {{ limit }} caractères autorisés'),
                    new Assert\NotNull(message: 'Le contenu du blog est obligatoire'),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('data_class', Blog::class);
    }
}