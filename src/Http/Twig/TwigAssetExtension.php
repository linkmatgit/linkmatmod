<?php

namespace App\Http\Twig;


use Psr\Cache\CacheItemPoolInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigAssetExtension extends AbstractExtension
{

    private ?array $manifestData = [];
    const CACHE_KEY = 'manifest_vite';

    public function __construct(
        private bool $isDev,
        private string $manifest,
        private CacheItemPoolInterface $cache
    )
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('encore_entry_script_tags', [$this, 'assets'], ['is_safe' => ['html']])
        ];
    }


    public function assets(string $entry, ?array $deps = null): string {
        if($this->isDev) {
            return $this->assetsDev($entry, $deps);
        }
        return $this->assetsProd($entry);
    }

    public function assetsDev(string $entry, array $deps) :string{

        $html =  <<<HTML
 <script type="module" src="http://linkmat.localhost:3000/assets/@vite/client"></script>
HTML;
        if(in_array('react', $deps)){
            $html .= '<script type="module">
import RefreshRuntime from "http://linkmat.localhost:3000/assets/@react-refresh"
RefreshRuntime.injectIntoGlobalHook(window)
window.$RefreshReg$ = () => {}
window.$RefreshSig$ = () => (type) => type
window.__vite_plugin_react_preamble_installed__ = true
</script>';
        }
       $html .= <<<HTML
        <script type="module" src="http://linkmat.localhost:3000/assets/{$entry}"></script>
HTML;

    return $html;
    }


    public function assetsProd(string $entry):string{
        if ($this->manifestData === null) {
            $item = $this->cache->getItem(self::CACHE_KEY);
            if ($item->isHit()) {
                $this->manifestData = $item->get();
            } else {
                $this->manifestData = json_decode(file_get_contents($this->manifest), true);
                var_dump('read');
                $item->set($this->manifestData);
                $this->cache->save($item);
            }
        }
        $file = $this->manifestData[$entry]['file'];
        $css = $this->manifestData[$entry]['css'] ?? [];
        $imports = $this->manifestData[$entry]['imports'] ?? [];
        $html = <<<HTML
<script type="module" src="/assets/{$file}" defer></script>
HTML;
        foreach($css as $cssFile) {
            $html .= <<<HTML
<link rel="stylesheet" media="screen" href="/assets/{$cssFile}"/>
HTML;
        }

        foreach($imports as $import) {
            $html .= <<<HTML
<link rel="modulepreload" href="/assets/{$import}"/>
HTML;
        }

        return $html;
    }

}