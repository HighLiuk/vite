<?php

namespace HighLiuk\Vite;

class Vite
{
    public function __construct(
        public readonly Manifest $manifest,
        public readonly string $host = 'http://localhost:5173'
    ) {
    }

    public function tags(): string
    {
        ob_start();

        if ($this->isDev()) {
            $this->printDevTags();
        } else {
            $this->printProductionTags();
        }

        return ob_get_clean() ?: '';
    }

    protected function isDev(): bool
    {
        $handle = curl_init($this->host . $this->manifest->entry);
        if (!$handle) {
            return false;
        }

        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_NOBODY, true);

        curl_exec($handle);
        $error = curl_errno($handle);
        curl_close($handle);

        return !$error;
    }

    protected function printDevTags(): void
    {
        $this->printScript($this->host . '@vite/client');
        $this->printScript($this->host . $this->manifest->entry);
    }

    protected function printProductionTags(): void
    {
        $this->printScript($this->manifest->asset);

        foreach ($this->manifest->imports as $url) {
            $this->printLink($url, 'modulepreload');
        }

        foreach ($this->manifest->css as $url) {
            $this->printLink($url, 'stylesheet');
        }
    }

    protected function printScript(string $src): void
    {
        echo <<<HTML
<script type="module" src="$src"></script>
HTML;
    }

    protected function printLink(string $href, string $rel): void
    {
        echo <<<HTML
<link href="$href" rel="$rel" />
HTML;
    }
}
