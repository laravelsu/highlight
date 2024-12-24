<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\CommonPatterns;

use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\TokenType;
use Tempest\Highlight\Tokens\DynamicTokenType;

class DelimeterPattern implements Pattern
{
    use IsPattern;

    public function __construct(
            private string $delimeter,
            private string $tokenType = 'hl-delimeter'
    ) {
    }

    public function getPattern(): string
    {
        return "/(?<match>{$this->delimeter})/";
    }

    public function getTokenType(): TokenType
    {
        return new DynamicTokenType($this->tokenType);
    }

}
