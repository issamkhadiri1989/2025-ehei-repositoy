<?php

declare(strict_types=1);

namespace App\DTO;

use App\Validator\Constraint\PasswordConstraint;

class UserDTO
{
    #[PasswordConstraint]
    private ?string $password = null;

    // ...
}
