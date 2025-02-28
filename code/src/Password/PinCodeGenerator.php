<?php

declare(strict_types=1);

namespace App\Password;

class PinCodeGenerator implements PinGeneratorInterface
{
    private const BASE_PIN_DIGITS = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    public function generate(int $length = 5): string
    {
        $output = '';

        for ($i = 0; $i < $length; $i++) {
            $randomDigit = \array_rand(self::BASE_PIN_DIGITS);

            $output .= $randomDigit;
        }

        return $output;
    }
}
