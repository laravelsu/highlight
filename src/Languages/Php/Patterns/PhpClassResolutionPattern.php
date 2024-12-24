<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Php\Patterns;

use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\TokenType;
use Tempest\Highlight\Tokens\DynamicTokenType;
use Laravelsu\Highlight\Tokens\CanNotContainTokenType;

final readonly class PhpClassResolutionPattern implements Pattern
{
    use IsPattern;

    public function getPattern(): string
    {
        return '\:\:(?<match>class)';
    }

    public function getTokenType(): TokenType
    {
        return new CanNotContainTokenType('hl-keyword');
    }
}
