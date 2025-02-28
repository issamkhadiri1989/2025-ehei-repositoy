<?php

declare(strict_types=1);

namespace App\Password;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.security.pin_generator')]
interface PinGeneratorInterface
{
    public function generate(int $length = 5): string;
}
