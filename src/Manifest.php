<?php

namespace HighLiuk\Vite;

class Manifest
{
    public readonly string $asset;

    /**
     * @var string[]
     */
    public readonly array $css;

    /**
     * @var string[]
     */
    public readonly array $assets;

    /**
     * @var string[]
     */
    public readonly array $imports;

    public readonly ?string $entry;

    public function __construct(
        public readonly string $dist_path,
        public readonly string $dist_url
    ) {
        $manifest = $this->loadManifest();

        $this->entry = $manifest !== null ? $this->getEntry($manifest) : null;
        $data = $manifest !== null ? $manifest[$this->entry] : null;

        $this->asset =
            $manifest !== null ? $this->getAsset($data) : $this->dist_url;
        $this->css = $manifest !== null ? $this->getCss($data) : [];
        $this->assets = $manifest !== null ? $this->getAssets($data) : [];
        $this->imports =
            $manifest !== null ? $this->getImports($data, $manifest) : [];
    }

    protected function getManifestPath(): string
    {
        return $this->dist_path . '.vite/manifest.json';
    }

    /**
     * @return ?mixed[]
     */
    protected function loadManifest(): ?array
    {
        $content = file_get_contents($this->getManifestPath());

        if (!$content) {
            return null;
        }

        return json_decode($content, true);
    }

    /**
     * @param mixed[] $manifest
     */
    protected function getEntry(array $manifest): ?string
    {
        foreach ($manifest as $entry => $data) {
            if ($data['isEntry'] ?? false) {
                return $entry;
            }
        }

        return null;
    }

    protected function getAsset(mixed $data): string
    {
        return $this->dist_url . $data['file'];
    }

    /**
     * @return string[]
     */
    protected function getCss(mixed $data): array
    {
        return array_map(
            fn($css) => $this->dist_url . $css,
            $data['css'] ?? []
        );
    }

    /**
     * @return string[]
     */
    public function getAssets(mixed $data): array
    {
        return array_map(
            fn($asset) => $this->dist_url . $asset,
            $data['assets'] ?? []
        );
    }

    /**
     * @param mixed[] $manifest
     * @return string[]
     */
    public function getImports(mixed $data, array $manifest): array
    {
        return array_map(
            fn($import) => $this->dist_url . ($manifest[$import]['file'] ?? ''),
            $data['imports'] ?? []
        );
    }
}
