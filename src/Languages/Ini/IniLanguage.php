<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Ini;

use Laravelsu\Highlight\Languages\CustomBase\CustomBaseLanguage;
use Laravelsu\Highlight\Languages\Ini\Patterns\IniConstantPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\DoubleQuoteValuePattern;
use Laravelsu\Highlight\Languages\Ini\Patterns\IniCommentPattern;

class IniLanguage extends CustomBaseLanguage
{
    public function getName(): string
    {
        return 'ini';
    }

    public function getAliases(): array
    {
        return [
            'env',
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
            (new DoubleQuoteValuePattern())->canNotContain(),
            new IniConstantPattern(),

            new IniCommentPattern(),
        ];
    }
}