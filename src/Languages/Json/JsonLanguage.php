<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Json;

use Laravelsu\Highlight\Languages\CustomBase\CustomBaseLanguage;
use Laravelsu\Highlight\Languages\Json\Patterns\JsonPropertyPattern;
use Laravelsu\Highlight\Languages\Json\Patterns\JsonDoubleQuoteValuePattern;
use Laravelsu\Highlight\Languages\Json\Injections\JsonArrayInjection;
use Laravelsu\Highlight\Languages\Json\Patterns\JsonDigitsValuePattern;
use Laravelsu\Highlight\Languages\CommonPatterns\KeywordPattern;

class JsonLanguage extends CustomBaseLanguage
{
    public function getName(): string
    {
        return 'json';
    }

    public function getInjections(): array
    {
        return [
            ...parent::getInjections(),
//            new JsonArrayInjection(),
        ];
    }

    public function getPatterns(): array
    {
        return [
            ...parent::getPatterns(),
            
            new KeywordPattern('(null|true|false)', 'hl-slug'),
            
            new JsonPropertyPattern(),
            new JsonDoubleQuoteValuePattern(),
            new JsonDigitsValuePattern(),
        ];
    }
}
