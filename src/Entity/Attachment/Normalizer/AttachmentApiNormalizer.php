<?php

namespace App\Entity\Attachment\Normalizer;



use App\Entity\Attachment\Attachment;
use App\Infrastructure\Image\ImageResizer;
use App\Infrastructure\Normalizer\Normalizer;
use JetBrains\PhpStorm\ArrayShape;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class AttachmentApiNormalizer extends Normalizer
{

    public function __construct(
       private UploaderHelper $uploaderHelper,
       private ImageResizer $resizer
    ) {

    }

    /**
     * @param Attachment $object
     */
    #[ArrayShape(['id' => "int|null", 'createdAt' => "int", 'name' => "string", 'size' => "int", 'url' => "null|string", 'thumbnail' => "string"])]
    public function normalize($object, string $format = null, array $context = []): array
    {
        $info = pathinfo($object->getFileName());
        $filenameParts = explode('-', $info['filename']);
        $filenameParts = array_slice($filenameParts, 0, -1);
        $filename = implode('-', $filenameParts);
        $extension = $info['extension'] ?? '';

        return [
            'id' => $object->getId(),
            'createdAt' => $object->getCreatedAt()->getTimestamp(),
            'name' => "{$filename}.{$extension}",
            'size' => $object->getFileSize(),
            'url' => $this->uploaderHelper->asset($object),
            'thumbnail' => $this->resizer->resize($this->uploaderHelper->asset($object), 250, 100),
        ];
    }

    /**
     * @param mixed $data ;
     */
    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof Attachment && 'json' === $format;
    }
}