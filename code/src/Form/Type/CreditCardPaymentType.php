<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CreditCardPaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class)
            ->add('cardNumber', TextType::class)
            ->add('expiresOn', ChoiceType::class, [
                    'choices' => $this->createExpirationDates(10),
                ]
            )
            ->add('cvv', TextType::class);
    }

    private function createExpirationDates(int $maxMonthCount): array
    {
        $today = new \DateTime();

        $choices = [];

        for ($i = 0; $i < $maxMonthCount; $i++) {
            $key = ($today = $today->add(new \DateInterval('P1M')))->format('m/Y');
            $choices[$key] = $key;
        }

        return $choices;
    }
}
