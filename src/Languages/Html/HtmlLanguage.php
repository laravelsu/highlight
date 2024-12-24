<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Html;

use Laravelsu\Highlight\Languages\Xml\XmlLanguage;
use Laravelsu\Highlight\Languages\Html\Injections\JavaScriptInHtmlInjection;

class HtmlLanguage extends XmlLanguage
{
    public function getName(): string
    {
        return 'html';
    }

    public function getInjections(): array
    {
        return [
            ...parent::getInjections(),
            new JavaScriptInHtmlInjection(),
        ];
    }

    public function getPatterns(): array
    {
        return [
            ...parent::getPatterns(),
        ];
    }
}
