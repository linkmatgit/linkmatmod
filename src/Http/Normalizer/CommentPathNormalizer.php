<?php

namespace App\Http\Normalizer;


use App\Entity\Blog\Post;
use App\Entity\Comment\Comment;
use App\Http\Encoder\PathEncoder;
use App\Infrastructure\Normalizer\Normalizer;


class CommentPathNormalizer extends Normalizer
{
    public function normalize($object, string $format = null, array $context = []): array
    {
        if ($object instanceof Comment) {
            $target = $object->getTarget();
            if ($target instanceof Post) {
                $path = (new PostPathNormalizer())->normalize($target, $format, $context);
            }

            $path['hash'] = "c{$object->getId()}";

            return $path;
        }
        throw new \RuntimeException("Can't normalize path");
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return ($data instanceof Comment)
            && PathEncoder::FORMAT === $format;
    }
}