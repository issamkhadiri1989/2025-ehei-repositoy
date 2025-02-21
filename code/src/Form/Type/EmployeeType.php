<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Association;
use App\Entity\Department;
use App\Entity\Employee;
use App\Repository\DepartmentRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class)
            ->add('emailAddress', EmailType::class)
            ->add('identityCode', TextType::class)
            ->add('department', EntityType::class, [
                'class' => Department::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'placeholder' => 'Choisir un département',
                'query_builder' => function (DepartmentRepository $repository) {
                    return $repository->getDepartmentsOrdered();
                }
            ])
            ->add('subscriptions', EntityType::class, [
                'class' => Association::class,
                'choice_label' => fn (Association $association) => \strtoupper($association->getName()),
                'choice_value' => 'id',
                'multiple' => true,
                //'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
