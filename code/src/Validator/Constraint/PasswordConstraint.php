<?php
 // src/Validator/Constraint/PasswordConstraint.php
declare(strict_types=1);

namespace App\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class PasswordConstraint extends Constraint
{
    public string $message = 'the password you entered does not meet password policy requirements.';

    public function __construct(?string $message = null, mixed $options = null, ?array $groups = null, mixed $payload = null)
    {
        parent::__construct($options, $groups, $payload);
        $this->message = $message ?? $this->message;
    }
}
