<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Validator\Constraint\PasswordConstraint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('password', PasswordType::class, [
                'constraints' => [
                    new PasswordConstraint(),
                    new NotNull(),
                    new NotBlank(),
                ],
            ])
            // ...
        ;
    }
}
