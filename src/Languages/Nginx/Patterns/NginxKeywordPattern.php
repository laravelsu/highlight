<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Nginx\Patterns;

use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\TokenType;
use Tempest\Highlight\Tokens\DynamicTokenType;

final class NginxKeywordPattern implements Pattern
{
    use IsPattern;

    public function getPattern(): string
    {
        return '/(\A|\n)(\s)*(?<match>(\w)*)\s/';
    }

    public function getTokenType(): TokenType
    {
        return new DynamicTokenType('hl-keyword');
    }
}
