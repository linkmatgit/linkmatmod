<?php

namespace App\Entity\Revision\Constraint;

use App\Entity\Revision\WipTagRevision;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class NotSameContentValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof NotSameContent) {
            throw new UnexpectedTypeException($constraint, NotSameContent::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!$value instanceof WipTagRevision) {
            throw new UnexpectedValueException($value, WipTagRevision::class);
        }

        if (null !== $value->getTarget() && $value->getContent() === $value->getTarget()->getContent()) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}