<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Shell\Patterns;

use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\DynamicTokenType;
use Tempest\Highlight\Tokens\TokenType;

final readonly class ShellKeyPattern implements Pattern
{
    use IsPattern;

    public function getPattern(): string
    {
        //return '/\s(?<match>[-]+(\S|=)+)/';
        return '/\s(?<match>[-]+(\w|=|\-|\S)+)/';
    }

    public function getTokenType(): TokenType
    {
        return new DynamicTokenType('hl-constant');
    }
}
