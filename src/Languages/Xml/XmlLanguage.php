<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Xml;

use Laravelsu\Highlight\Languages\CustomBase\CustomBaseLanguage;
use Laravelsu\Highlight\Languages\Xml\Patterns\XmlDoctypePattern;
use Laravelsu\Highlight\Languages\Xml\Patterns\XmlDoctypeTypePattern;
use Laravelsu\Highlight\Languages\Xml\Patterns\XmlOpenTagPattern;
use Laravelsu\Highlight\Languages\Xml\Patterns\XmlCloseTagPattern;
use Laravelsu\Highlight\Languages\Xml\Patterns\XmlStartOpenTagPattern;
use Laravelsu\Highlight\Languages\Xml\Patterns\XmlEndCloseTagPattern;
use Laravelsu\Highlight\Languages\Xml\Patterns\XmlAttributePattern;
use Laravelsu\Highlight\Languages\Xml\Patterns\XmlAttributeValuePattern;
use Laravelsu\Highlight\Languages\Xml\Patterns\XmlAttributeDelimeterPattern;
use Laravelsu\Highlight\Languages\Xml\Patterns\XmlCommentPattern;

class XmlLanguage extends CustomBaseLanguage
{
    public function getName(): string
    {
        return 'xml';
    }

    public function getInjections(): array
    {
        return [
            ...parent::getInjections(),
        ];
    }

    public function getPatterns(): array
    {
        return [
            ...parent::getPatterns(),
            new XmlDoctypePattern(),
            new XmlDoctypeTypePattern(),
            new XmlOpenTagPattern(),
            new XmlCloseTagPattern(),
            new XmlAttributePattern(),
            new XmlAttributeValuePattern(),
            new XmlAttributeDelimeterPattern(),
            new XmlCommentPattern(),

            new XmlStartOpenTagPattern(),
            new XmlEndCloseTagPattern(),
        ];
    }
}
