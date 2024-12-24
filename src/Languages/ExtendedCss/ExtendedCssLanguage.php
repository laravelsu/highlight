<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\ExtendedCss;

use Tempest\Highlight\Languages\Css\CssLanguage;
use Laravelsu\Highlight\Languages\CustomBase\Injections\TLAddInjection;
use Laravelsu\Highlight\Languages\CustomBase\Injections\TLRemoveInjection;
use Laravelsu\Highlight\Languages\CustomBase\Injections\TLAddMultilineStartInjection;
use Laravelsu\Highlight\Languages\CustomBase\Injections\TLAddMultilineEndInjection;
use Laravelsu\Highlight\Languages\CustomBase\Injections\TLRemoveMultilineStartInjection;
use Laravelsu\Highlight\Languages\CustomBase\Injections\TLRemoveMultilineEndInjection;
use Laravelsu\Highlight\Languages\ExtendedCss\Patterns\CssConfigPattern;
use Laravelsu\Highlight\Languages\ExtendedCss\Patterns\CssTailwindPattern;

class ExtendedCssLanguage extends CssLanguage
{
    public function getInjections(): array
    {
        return [
            new TLAddInjection(),
            new TLRemoveInjection(),
            new TLAddMultilineStartInjection(),
            new TLAddMultilineEndInjection(),
            new TLRemoveMultilineStartInjection(),
            new TLRemoveMultilineEndInjection(),
            ...parent::getInjections(),
        ];
    }

    public function getPatterns(): array
    {
        return [
            ...parent::getPatterns(),
            new CssConfigPattern(),
            new CssTailwindPattern(),
        ];
    }
}
