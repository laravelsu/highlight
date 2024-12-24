<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Blade\Patterns;

use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\TokenType;
use Tempest\Highlight\Tokens\DynamicTokenType;

final readonly class BladeKeywordPattern implements Pattern
{
    use IsPattern;

    public function getPattern(): string
    {
        return '\s*(?<match>\@(?!(php|endphp))[\w]+)\b';
    }

    public function getTokenType(): TokenType
    {
        return new DynamicTokenType('hl-keyword');
    }
}
