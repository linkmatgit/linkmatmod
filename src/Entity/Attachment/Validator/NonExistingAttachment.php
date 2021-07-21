<?php

namespace App\Entity\Attachment\Validator;

use App\Entity\Attachment\Attachment;

class NonExistingAttachment extends Attachment
{
    public function __construct(int $expectedId)
    {
        $this->id = $expectedId;
    }
}