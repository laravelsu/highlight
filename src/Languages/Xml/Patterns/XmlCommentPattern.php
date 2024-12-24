<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Xml\Patterns;

use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\TokenType;
use Laravelsu\Highlight\Tokens\CanNotContainTokenType;

final readonly class XmlCommentPattern implements Pattern
{
    use IsPattern;

    public function getPattern(): string
    {
        return '/(?<match>\<!--(.|\n)*-->)/mU';
    }

    public function getTokenType(): TokenType
    {
        return new CanNotContainTokenType('hl-comment');
    }
}
