<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Nginx;

use Laravelsu\Highlight\Languages\CustomBase\CustomBaseLanguage;
use Laravelsu\Highlight\Languages\Nginx\Patterns\NginxKeywordPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\DoubleQuoteValuePattern;
use Laravelsu\Highlight\Languages\CommonPatterns\KeywordPattern;
use Laravelsu\Highlight\Languages\Nginx\Patterns\NginxVariablesPattern;
use Laravelsu\Highlight\Languages\Nginx\Patterns\NginxLocationPathPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\OperatorPattern;

class NginxLanguage extends CustomBaseLanguage
{
    public function getName(): string
    {
        return 'nginx';
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
            new KeywordPattern('(access_log|log_not_found)'),
            
            new NginxKeywordPattern(),

            new OperatorPattern('(=|~)'),
        
            new NginxLocationPathPattern(),
            new DoubleQuoteValuePattern(),
            new NginxVariablesPattern(),
        ];
    }
}
