<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Php;

use Laravelsu\Highlight\Languages\CustomBase\CustomBaseLanguage;
use Laravelsu\Highlight\Languages\Php\Injections\PhpTypeForVariableInjection;
use Laravelsu\Highlight\Languages\CommonPatterns\KeywordPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\OperatorPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\SingleQuoteValuePattern;
use Laravelsu\Highlight\Languages\CommonPatterns\DigitsPattern;

final class PhpTypeLanguage extends CustomBaseLanguage
{
    public function getName(): string
    {
        return 'phptype';
    }

    public function getInjections(): array
    {
        return [
            ...parent::getInjections(),
            new PhpTypeForVariableInjection(),
        ];
    }

    public function getPatterns(): array
    {
        return [
            ...parent::getPatterns(),

            // COMMENTS

            new OperatorPattern('(<|=>|>|=|\*)'),
            new KeywordPattern('(protected|public|private|use)'),
            new KeywordPattern('(null|true|false)', 'hl-constant'),
            
            // VARIABLES
            
            new DigitsPattern(),
            new SingleQuoteValuePattern(),
        ];
    }
}
