<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\ExtendedCss\Patterns;

use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\TokenType;
use Tempest\Highlight\Tokens\DynamicTokenType;

final readonly class CssConfigPattern implements Pattern
{
    use IsPattern;

    public function getPattern(): string
    {
        return '(?<match>\@config)';
    }

    public function getTokenType(): TokenType
    {
        return new DynamicTokenType('hl-keyword');
    }
}
