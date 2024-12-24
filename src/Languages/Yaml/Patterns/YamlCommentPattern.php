<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Yaml\Patterns;

use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\TokenType;
use Laravelsu\Highlight\Tokens\CanNotContainTokenType;

final readonly class YamlCommentPattern implements Pattern
{
    use IsPattern;

    public function getPattern(): string
    {
        return '(?<match>\#(.)*)';
    }

    public function getTokenType(): TokenType
    {
        return new CanNotContainTokenType('hl-comment');
    }
}
