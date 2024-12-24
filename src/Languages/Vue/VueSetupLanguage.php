<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Vue;

use Laravelsu\Highlight\Languages\CustomBase\CustomBaseLanguage;
use Laravelsu\Highlight\Languages\CommonPatterns\KeywordPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\SingleQuoteValuePattern;
use Laravelsu\Highlight\Languages\Vue\Patterns\VueFunctionCallPattern;
use Laravelsu\Highlight\Languages\Vue\Patterns\VueConstNamePattern;
use Laravelsu\Highlight\Languages\CommonPatterns\OperatorPattern;

class VueSetupLanguage extends CustomBaseLanguage
{
    public function getName(): string
    {
        return 'vuesetup';
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
            new KeywordPattern('(import|from|const)'),
            
            new VueFunctionCallPattern(),
            new VueConstNamePattern(),
            
            new OperatorPattern('(<|=>|>|=|\*)'),
            
            new SingleQuoteValuePattern(),

        ];
    }
}
