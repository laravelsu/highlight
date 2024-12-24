<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Xml\Patterns;

use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\TokenType;
use Laravelsu\Highlight\Tokens\CanNotContainTokenType;

final readonly class XmlAttributeValuePattern implements Pattern
{
    use IsPattern;

    public function getPattern(): string
    {
        return '/[\w\-:]*[\w\-]+=(?<match>"(.|\n)*?")/';
    }

    public function getTokenType(): TokenType
    {
        return new CanNotContainTokenType('hl-value');
    }
}
