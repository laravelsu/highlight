<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Json\Patterns;

use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\TokenType;
use Laravelsu\Highlight\Tokens\CanNotContainTokenType;

final readonly class JsonDoubleQuoteValuePattern implements Pattern
{
    use IsPattern;

    public function getPattern(): string
    {
        return '(\:|\[)(\s|\n)*\"(?<match>.*?)\"';
    }

    public function getTokenType(): TokenType
    {
        return new CanNotContainTokenType('hl-json-value');
    }
}
