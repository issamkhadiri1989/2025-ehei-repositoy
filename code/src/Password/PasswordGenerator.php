<?php

declare(strict_types=1);

namespace App\Password;

use Symfony\Component\DependencyInjection\Attribute\AsAlias;

#[AsAlias]
class PasswordGenerator implements PinGeneratorInterface
{
    public function generate(int $length = 5): string
    {
        return \bin2hex(\random_bytes($length));
    }
}
