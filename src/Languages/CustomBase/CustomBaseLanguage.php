<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\CustomBase;

use Tempest\Highlight\Languages\Base\BaseLanguage;
use Laravelsu\Highlight\Languages\CustomBase\Injections\TLAddInjection;
use Laravelsu\Highlight\Languages\CustomBase\Injections\TLRemoveInjection;
use Laravelsu\Highlight\Languages\CustomBase\Injections\TLAddMultilineStartInjection;
use Laravelsu\Highlight\Languages\CustomBase\Injections\TLAddMultilineEndInjection;
use Laravelsu\Highlight\Languages\CustomBase\Injections\TLRemoveMultilineStartInjection;
use Laravelsu\Highlight\Languages\CustomBase\Injections\TLRemoveMultilineEndInjection;

abstract class CustomBaseLanguage extends BaseLanguage
{
    public function getInjections(): array
    {
        return [
            ...parent::getInjections(),
            new TLAddInjection(),
            new TLRemoveInjection(),
            new TLAddMultilineStartInjection(),
            new TLAddMultilineEndInjection(),
            new TLRemoveMultilineStartInjection(),
            new TLRemoveMultilineEndInjection(),
        ];
    }

    public function getPatterns(): array
    {
        return [
            ...parent::getPatterns(),
        ];
    }
}
