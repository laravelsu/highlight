<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Xml\Patterns;

use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\TokenType;
use Tempest\Highlight\Tokens\DynamicTokenType;

final readonly class XmlOpenTagPattern implements Pattern
{
    use IsPattern;

    public function getPattern(): string
    {
        return '/<(\?)?(?!php)(?<match>[\w\-\:\.]+)/';
    }

    public function getTokenType(): TokenType
    {
        return new DynamicTokenType('hl-tag');
    }
}
