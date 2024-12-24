<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Vue;

use Laravelsu\Highlight\Languages\Html\HtmlLanguage;
use Laravelsu\Highlight\Languages\Vue\Injections\VueScriptSetupInjection;

class VueLanguage extends HtmlLanguage
{
    public function getName(): string
    {
        return 'vue';
    }

    public function getInjections(): array
    {
        return [
            ...parent::getInjections(),
            new VueScriptSetupInjection(),
        ];
    }

    public function getPatterns(): array
    {
        return [
            ...parent::getPatterns(),
        ];
    }
}
