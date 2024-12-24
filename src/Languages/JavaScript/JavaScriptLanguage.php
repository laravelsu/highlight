<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\JavaScript;

use Laravelsu\Highlight\Languages\CustomBase\CustomBaseLanguage;
use Laravelsu\Highlight\Languages\JavaScript\Patterns\JsPropertyPattern;
use Laravelsu\Highlight\Languages\JavaScript\Patterns\JsMethodPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\DigitsPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\SingleQuoteValuePattern;
use Laravelsu\Highlight\Languages\CommonPatterns\KeywordPattern;
use Laravelsu\Highlight\Languages\JavaScript\Patterns\JsSinglelineCommentPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\SingleApostropheValuePattern;
use Laravelsu\Highlight\Languages\JavaScript\Patterns\JsConstantNamePattern;
use Laravelsu\Highlight\Languages\CommonPatterns\OperatorPattern;
use Laravelsu\Highlight\Languages\JavaScript\Patterns\JsFunctionEPattern;
use Laravelsu\Highlight\Languages\JavaScript\Patterns\JsMultilineCommentPattern;
use Laravelsu\Highlight\Languages\JavaScript\Injections\JsHTMLInjection;

class JavaScriptLanguage extends CustomBaseLanguage
{
    public function getName(): string
    {
        return 'js';
    }

    public function getAliases(): array
    {
        return [
            'javascript',
            'node',
            'jsx',
        ];
    }

    public function getInjections(): array
    {
        return [
            ...parent::getInjections(),
            new JsHTMLInjection(),
        ];
    }

    public function getPatterns(): array
    {
        $keywords = '(' . implode('|', JsConst::JS_KEYWORDS) . ')';

        return [
            ...parent::getPatterns(),
            new KeywordPattern($keywords),
            new KeywordPattern('(null|false|this|true)', 'hl-slug'),

            new OperatorPattern('(=|\?\?|===)'),
            
            // COMMENTS
            new JsMultilineCommentPattern(),
            new JsSinglelineCommentPattern(),

            // TYPES

            // PROPERTIES
            new JsPropertyPattern(),
            new JsMethodPattern(),

            // VALUES
            (new SingleQuoteValuePattern())->canNotContain(),
            new SingleApostropheValuePattern(),
            
            new JsConstantNamePattern(),

            new DigitsPattern(),
            new JsFunctionEPattern(),
        ];
    }
}
