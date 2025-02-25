<?php

declare(strict_types=1);

namespace App\Password;

class PasswordGenerator
{
    public function generate(int $length = 5): string
    {
        return \bin2hex(\random_bytes($length));
    }
}
