<?php

namespace App\Entity\Revision\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class NotSameContent extends Constraint
{
    public string $message = "La révision doit posséder au moins une modification par rapport à l'article original";

    public function getTargets(): array|string
    {
        return Constraint::CLASS_CONSTRAINT;
    }
}