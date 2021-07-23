<?php

namespace App\Http\Normalizer;


use App\Entity\Blog\Category;
use App\Http\Encoder\PathEncoder;
use App\Infrastructure\Normalizer\Normalizer;


class CategoryPathNormalizer extends Normalizer
{
    public function normalize($object, string $format = null, array $context = []): array
    {
        if ($object instanceof Category) {
            return [
                'path' => 'app_blog_category',
                'params' => ['slug' => $object->getSlug()],
            ];
        }
        throw new \RuntimeException("Can't normalize path");
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return ($data instanceof Category)
            && PathEncoder::FORMAT === $format;
    }
}
