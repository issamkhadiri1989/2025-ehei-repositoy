<?php

declare(strict_types=1);

namespace App\Tests\App\Validator\Constraint;

use App\Validator\Constraint\PasswordConstraint;
use App\Validator\Constraint\PasswordConstraintValidator;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class PasswordConstraintValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): ConstraintValidatorInterface
    {
        return new PasswordConstraintValidator();
    }

    public function testNullIsValid(): void
    {
        $this->validator->validate(null, new PasswordConstraint());

        $this->assertNoViolation();
    }

    /**
     * @dataProvider caseProvider
     */
    public function testInvalidPassword(PasswordConstraint $constraint, string $expected): void
    {
        $this->validator->validate('Abc123', $constraint);

        $this->buildViolation($expected)
            ->assertRaised();
    }

    public function caseProvider(): \Generator
    {
        yield [new PasswordConstraint(message: 'My Custom message'), 'My Custom message'];
        yield [new PasswordConstraint(), 'the password you entered does not meet password policy requirements.'];
    }
}
