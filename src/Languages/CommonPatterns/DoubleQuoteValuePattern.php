<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\CommonPatterns;

use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\TokenType;
use Tempest\Highlight\Tokens\DynamicTokenType;
use Laravelsu\Highlight\Tokens\CanNotContainTokenType;

final class DoubleQuoteValuePattern implements Pattern
{
    use IsPattern;

    private bool $canNotContain = false;

    public function __construct(
        private string $tokenType = 'hl-value',
    )
    {
    }

    public function canNotContain(): self
    {
        $this->canNotContain = true;

        return $this;
    }

    public function getPattern(): string
    {
        return '(?<match>"(.|\n)*?")';
    }

    public function getTokenType(): TokenType
    {
        if ($this->canNotContain) {
            return new CanNotContainTokenType($this->tokenType);
        }

        return new DynamicTokenType($this->tokenType);
    }
}
