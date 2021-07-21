<?php

namespace App\Http\Twig;

use ApiPlatform\Core\Api\UrlGeneratorInterface;
use Parsedown;
use Symfony\Component\Serializer\SerializerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TwigUrlExtension extends AbstractExtension
{

    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
        private SerializerInterface $serializer
    )
    {
    }

    public function getFunctions(): array
    {
        return [

            new TwigFunction('path', [$this, 'pathFor']),

        ];
    }

    public function getFilters(): array
    {
        return [

            new TwigFilter('autolink', [$this, 'autoLink']),
        ];
    }
    public function autoLink(string $string): string
    {
        $regexp = '/(<a.*?>)?(https?:)?(\/\/)(\w+\.)?(\w+\.[\w\/\-_.~&=?]+)(<\/a>)?/i';
        $anchor = '<a href="%s//%s" target="_blank" rel="noopener noreferrer">%s</a>';

        preg_match_all($regexp, $string, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            if (empty($match[1]) && empty($match[6])) {
                $protocol = $match[2] ? $match[2] : 'https:';
                $replace = sprintf($anchor, $protocol, $match[5], $match[0]);
                $string = str_replace($match[0], $replace, $string);
            }
        }

        return $string;
    }
    public function pathFor($path, array $params = []): string
    {
        if (is_string($path)) {
            return $this->urlGenerator->generate($path, $params);
        }

        return $this->serializer->serialize($path, 'path', ['url' => false]);
    }
}