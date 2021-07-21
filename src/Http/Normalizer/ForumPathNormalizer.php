<?php

namespace App\Http\Normalizer;

use App\Entity\Forum\Entity\ForumMessage;
use App\Entity\Forum\Entity\ForumTag;
use App\Entity\Forum\Entity\ForumTopic;
use App\Http\Encoder\PathEncoder;
use App\Infrastructure\Normalizer\Normalizer;


class ForumPathNormalizer extends Normalizer
{
    public function normalize($object, string $format = null, array $context = []): array
    {
        if ($object instanceof ForumTag) {
            return [
                'path' => 'forum_tag',
                'params' => ['id' => $object->getId(), 'slug' => $object->getSlug()],
            ];
        } elseif ($object instanceof ForumTopic) {
            return [
                'path' => 'forum_show',
                'params' => ['id' => $object->getId()],
            ];
        } elseif ($object instanceof ForumMessage) {
            return [
                'path' => 'forum_show',
                'params' => ['id' => $object->getTopic()->getId()],
                'hash' => 'message-'.$object->getId(),
            ];
        }
        throw new \RuntimeException("Can't normalize path");
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return ($data instanceof ForumTag || $data instanceof ForumTopic || $data instanceof ForumMessage)
            && PathEncoder::FORMAT === $format;
    }
}