<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Yaml;

use Laravelsu\Highlight\Languages\CustomBase\CustomBaseLanguage;
use Laravelsu\Highlight\Languages\Yaml\Patterns\YamlPropertyPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\DigitsPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\DoubleQuoteValuePattern;
use Laravelsu\Highlight\Languages\Yaml\Patterns\YamlCommentPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\KeywordPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\SingleQuoteValuePattern;

class YamlLanguage extends CustomBaseLanguage
{
    public function getName(): string
    {
        return 'yaml';
    }

    public function getAliases(): array
    {
        return [
            'yml',
        ];
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
            new YamlPropertyPattern(),
            new YamlCommentPattern(),
            
            new KeywordPattern('true', 'hl-slug'),

            new DigitsPattern(),
            (new DoubleQuoteValuePattern())->canNotContain(),
            (new SingleQuoteValuePattern())->canNotContain(),
        ];
    }
}
