<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Php;

use Laravelsu\Highlight\Languages\CustomBase\CustomBaseLanguage;
use Laravelsu\Highlight\Languages\CommonPatterns\KeywordPattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpOpenTagPattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpCloseTagPattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpClassNamePattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpUsePattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpExtendsPattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpFunctionCallPattern;
use Laravelsu\Highlight\Languages\Php\Injections\PhpReturnTypeInjection;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpStaticClassCallPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\OperatorPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\DelimeterPattern;
use Laravelsu\Highlight\Languages\Php\Injections\PhpDocCommentInjection;
use Laravelsu\Highlight\Languages\CommonPatterns\SingleQuoteValuePattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpConstantNamePattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpSinglelineCommentPattern;
use Laravelsu\Highlight\Languages\Php\Injections\PhpFunctionParametersInjection;
use Laravelsu\Highlight\Languages\CommonPatterns\DigitsPattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpNamedArgumentPattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpNewObjectPattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpInstanceOfPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\GenericPattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpImplementsPattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpEnumBackedTypePattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpEnumCasePattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpClassResolutionPattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpConstantPropertyPattern;
use Laravelsu\Highlight\Languages\Php\Injections\PhpHeredocInjection;
use Laravelsu\Highlight\Languages\CommonPatterns\DoubleQuoteValuePattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpMultilineCommentPattern;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpCatchTypePattern;

class PhpLanguage extends CustomBaseLanguage
{
    public function getName(): string
    {
        return 'php';
    }

    public function getAliases(): array
    {
        return ['txt'];
    }

    public function getInjections(): array
    {
        return [
            ...parent::getInjections(),
            new PhpHeredocInjection(),
            new PhpDocCommentInjection(),
            new PhpFunctionParametersInjection(),
            
            new PhpReturnTypeInjection(),
        ];
    }

    public function getPatterns(): array
    {
        $keywords = '(' . implode('|', PhpConst::PHP_KEYWORDS) . ')';
        
        return [
            ...parent::getPatterns(),

            new PhpOpenTagPattern(),
            new PhpCloseTagPattern(),
            new PhpClassNamePattern(),
            new PhpNamedArgumentPattern(),
            new OperatorPattern('(!==|===|==|<=>|<|<=|=>|>|=|\*|\+\+|\+|&&|\?|\|\|)'),
            new DelimeterPattern('(\:\:|->|\.)'),
            
            // KEYWORDS
            new KeywordPattern($keywords),
            new KeywordPattern('(null|true|false|instanceof|echo|new)', 'hl-constant'),
            new GenericPattern('/(?<match>\$this)(\-|\$|\,|\)|\;|\:|\s|\(|\])/', 'hl-tag2'),
            new GenericPattern('/\->\b(?<match>[\w]+?)\b(?!\()/', 'hl-delimeter'),
            new GenericPattern('/(?<match>\+\+)/', 'hl-constant'),
            new GenericPattern('/\((?<match>(string))\)/', 'hl-keyword'),

            new DigitsPattern(),
            new PhpClassResolutionPattern(),

            // COMMENTS
            new PhpMultilineCommentPattern(),
            new PhpSinglelineCommentPattern(),

            new PhpConstantNamePattern(),

            // TYPES
            new PhpImplementsPattern(),
            new PhpExtendsPattern(),
            new PhpUsePattern(),
            new PhpStaticClassCallPattern(),
            new PhpNewObjectPattern(),
            new PhpInstanceOfPattern(),
            new PhpCatchTypePattern(),
            new PhpEnumBackedTypePattern(),

            // PROPERTIES
            new PhpFunctionCallPattern(),
            new PhpConstantPropertyPattern(),
            new PhpEnumCasePattern(),

            // VARIABLES

            // VALUES
            (new SingleQuoteValuePattern())->canNotContain(),
            (new DoubleQuoteValuePattern())->canNotContain(),
        ];
    }
}
