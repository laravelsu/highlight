<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Blade\Injections;

use Tempest\Highlight\Highlighter;
use Tempest\Highlight\Injection;
use Tempest\Highlight\IsInjection;
use Tempest\Highlight\Escape;

final readonly class BladeEchoInjection implements Injection
{
    use IsInjection;

    public function getPattern(): string
    {
        return '({{(?!--))(?<match>(.|\n)*?)(}})';
    }

    public function parseContent(string $content, Highlighter $highlighter): string
    {
        return $highlighter->parse(Escape::terminal($content), 'php');
    }
}
