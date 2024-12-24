<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Blade;

use Laravelsu\Highlight\Languages\Html\HtmlLanguage;
use Laravelsu\Highlight\Languages\Blade\Injections\BladePhpInjection;
use Laravelsu\Highlight\Languages\Blade\Injections\BladeEchoInjection;
use Laravelsu\Highlight\Languages\Blade\Patterns\BladeKeywordPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\GenericPattern;
use Laravelsu\Highlight\Languages\Blade\Injections\BladeRawEchoInjection;
use Laravelsu\Highlight\Languages\CommonPatterns\DelimeterPattern;
use Laravelsu\Highlight\Languages\Blade\Patterns\BladeEscapeSymbolPattern;
use Laravelsu\Highlight\Languages\Blade\Patterns\BladeCommentPattern;
use Laravelsu\Highlight\Languages\Blade\Injections\BladeKeywordParametersInjection;
use Laravelsu\Highlight\Languages\CommonPatterns\SingleQuoteValuePattern;

class BladeLanguage extends HtmlLanguage
{
    public function getName(): string
    {
        return 'blade';
    }

    public function getAliases(): array
    {
        return ['html'];
    }

    public function getInjections(): array
    {
        return [
            ...parent::getInjections(),
            new BladePhpInjection(),
            new BladeKeywordParametersInjection(),
            new BladeEchoInjection(),
            new BladeRawEchoInjection(),
        ];
    }

    public function getPatterns(): array
    {
        return [
            ...parent::getPatterns(),
            new BladeKeywordPattern(),
            new BladeCommentPattern(),
            
            new DelimeterPattern('({!!|!!}|=\>)'),
            new GenericPattern('/(?<match>({{(?!\-\-)))/', 'hl-delimeter'),
            new GenericPattern('/[^\-](?<match>(}}))/', 'hl-delimeter'),
            new BladeEscapeSymbolPattern(),
            
            (new SingleQuoteValuePattern())->canNotContain(),
        ];
    }
}
