<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\CommonPatterns;

use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\TokenType;
use Tempest\Highlight\Tokens\DynamicTokenType;
use Laravelsu\Highlight\Tokens\CanNotContainTokenType;

final class KeywordPattern implements Pattern
{
    use IsPattern;

    private bool $caseInsensitive = false;

    private bool $canNotContain = false;

    public function __construct(
        private string $keyword,
        private string $tokenType = 'hl-keyword',
    ) {
    }

    public function caseInsensitive(): self
    {
        $this->caseInsensitive = true;

        return $this;
    }

    public function canNotContain(): self
    {
        $this->canNotContain = true;

        return $this;
    }

    public function getPattern(): string
    {
        $pattern = "/\b(?<!\\$)(?<!\-\>)*(?<match>{$this->keyword})(\$|\,|\.|\)|\;|\:|\s|\(|\-\>|\])/";

        if ($this->caseInsensitive) {
            $pattern .= 'i';
        }

        return $pattern;
    }

    public function getTokenType(): TokenType
    {
        if ($this->canNotContain)
        {
            return new CanNotContainTokenType($this->tokenType);
        }
        else
        {
            return new DynamicTokenType($this->tokenType);
        }
    }
}
