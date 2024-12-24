<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Php\Patterns;

use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\TokenType;
use Laravelsu\Highlight\Tokens\CanNotContainTokenType;

final readonly class PhpNewObjectPattern implements Pattern
{
    use IsPattern;

    public function getPattern(): string
    {
        return '/new [\w\\\\]*\b(?<match>[\w]+)/';
    }

    public function getTokenType(): TokenType
    {
        return new CanNotContainTokenType('hl-type');
    }
}
