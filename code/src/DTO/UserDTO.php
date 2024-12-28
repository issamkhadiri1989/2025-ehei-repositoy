<?php

declare(strict_types=1);

namespace App\DTO;

use App\Validator\Constraint\PasswordConstraint;

class UserDTO
{
    private string $email;

    #[PasswordConstraint]
    private ?string $password = null;

    // ...

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
