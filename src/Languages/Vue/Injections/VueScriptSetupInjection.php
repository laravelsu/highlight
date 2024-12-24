<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Vue\Injections;

use Tempest\Highlight\Highlighter;
use Tempest\Highlight\Injection;
use Tempest\Highlight\IsInjection;
use Laravelsu\Highlight\Languages\Vue\VueSetupLanguage;

final readonly class VueScriptSetupInjection implements Injection
{
    use IsInjection;

    public function getPattern(): string
    {
        return '/(setup( )*>)(?<match>(.|\n)*?)(\<\/( )*)/';
    }

    public function parseContent(string $content, Highlighter $highlighter): string
    {
        return $highlighter->parse($content, new VueSetupLanguage());
    }
}
