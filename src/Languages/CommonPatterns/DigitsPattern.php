<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\CommonPatterns;

use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\TokenType;
use Tempest\Highlight\Tokens\DynamicTokenType;

final readonly class DigitsPattern implements Pattern
{
    use IsPattern;

    public function __construct(
        private string $tokenType = 'hl-number',
    ) {
    }

    public function getPattern(): string
    {
        return '/[\w]*\b(?<match>[0-9]+)[\w]*/';
    }

    public function getTokenType(): TokenType
    {
        return new DynamicTokenType($this->tokenType);
    }
}
