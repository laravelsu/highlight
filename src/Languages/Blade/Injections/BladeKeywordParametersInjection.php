<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Blade\Injections;

use Tempest\Highlight\Highlighter;
use Tempest\Highlight\Injection;
use Tempest\Highlight\IsInjection;

final readonly class BladeKeywordParametersInjection implements Injection
{
    use IsInjection;

    public function getPattern(): string
    {
        return '/\@[\w]+\b(\s)*\((?<match>.*)\)/';
    }

    public function parseContent(string $content, Highlighter $highlighter): string
    {
        return $highlighter->parse($content, 'php');
    }
}
