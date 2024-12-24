<?php
// src/Validator/Constraint/PasswordConstraintValidator.php
declare(strict_types=1);

namespace App\Validator\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class PasswordConstraintValidator extends ConstraintValidator
{
    private const PASSWORD_PATTERN = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/';

    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof PasswordConstraint) {
            throw new UnexpectedTypeException(expectedType: PasswordConstraint::class, value: $constraint);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (\is_string($value) === false) {
            throw new UnexpectedValueException($value, 'string');
        }

        // preg_match() returns 1 if the pattern is matched
        if (\preg_match(self::PASSWORD_PATTERN, $value) === 1) {
            return;
        }

        // otherwise and error or pattern not matched
        $this->context->buildViolation($constraint->message)
            ->addViolation();
    }
}
