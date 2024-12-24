<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Sql;

use Laravelsu\Highlight\Languages\CustomBase\CustomBaseLanguage;
use Laravelsu\Highlight\Languages\CommonPatterns\KeywordPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\DigitsPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\OperatorPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\SingleQuoteValuePattern;
use Laravelsu\Highlight\Languages\CommonPatterns\SingleApostropheValuePattern;

class SqlLanguage extends CustomBaseLanguage
{
    public function getName(): string
    {
        return 'sql';
    }

    public function getInjections(): array
    {
        return [
            ...parent::getInjections(),
        ];
    }

    public function getPatterns(): array
    {
        $keywords = '(' . implode('|', SqlConst::SQL_KEYWORDS) . ')';

        return [
            ...parent::getPatterns(),

            new DigitsPattern(),

            new OperatorPattern('(>|=|>=)'),
            new OperatorPattern('(\*)', 'hl-delimeter'),
            
            // KEYWORDS
            (new KeywordPattern($keywords))->caseInsensitive(),

            // COMMENTS

            // TYPES

            // VALUES
            new SingleQuoteValuePattern(),
            new SingleApostropheValuePattern(),

            // PROPERTIES
        ];
    }
}
