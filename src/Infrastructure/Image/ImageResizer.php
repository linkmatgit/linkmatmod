<?php

namespace App\Infrastructure\Image;

use League\Glide\Urls\UrlBuilderFactory;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ImageResizer
{
    public function __construct(
        private string $signKey,
        private UrlGeneratorInterface $urlGenerator)
    {

    }

    public function resize(?string $url, ?int $width = null, ?int $height = null): string
    {
        if (null === $url || empty($url)) {
            return '';
        }
        if (null === $width && null === $height) {
            $url = $this->urlGenerator->generate('image_jpg', ['path' => trim($url, '/')]);
        } else {
            $url = $this->urlGenerator->generate('image_resizer', ['path' => trim($url, '/'), 'width' => $width, 'height' => $height]);
        }
        $urlBuilder = UrlBuilderFactory::create('/', $this->signKey);

        return $urlBuilder->getUrl($url);
    }
}