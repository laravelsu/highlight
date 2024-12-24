<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Php;

use Laravelsu\Highlight\Languages\CustomBase\CustomBaseLanguage;
use Laravelsu\Highlight\Languages\Php\Injections\PhpDocCommentReturnTypeInjection;
use Laravelsu\Highlight\Languages\Php\Patterns\PhpDocCommentTagPattern;
use Laravelsu\Highlight\Languages\Php\Injections\PhpDocCommentParamTypeInjection;

class PhpDocCommentLanguage extends CustomBaseLanguage
{
    public function getName(): string
    {
        return 'phpdoc';
    }

    public function getInjections(): array
    {
        return [
            ...parent::getInjections(),
            new PhpDocCommentParamTypeInjection(),
            new PhpDocCommentReturnTypeInjection(),
        ];
    }

    public function getPatterns(): array
    {
        return [
            ...parent::getPatterns(),
            new PhpDocCommentTagPattern(),
        ];
    }
}
