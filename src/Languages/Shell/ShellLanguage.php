<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Shell;

use Laravelsu\Highlight\Languages\CustomBase\CustomBaseLanguage;
use Laravelsu\Highlight\Languages\Shell\Patterns\ShellKeyPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\DoubleQuoteValuePattern;
use Laravelsu\Highlight\Languages\Shell\Patterns\ShellSinglelineCommentPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\DelimeterPattern;
use Laravelsu\Highlight\Languages\CommonPatterns\SingleQuoteValuePattern;

class ShellLanguage extends CustomBaseLanguage
{
    public function getName(): string
    {
        return 'shell';
    }

    public function getAliases(): array
    {
        return [
            'sh',
            'bash'
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
            new ShellKeyPattern(),
            (new SingleQuoteValuePattern())->canNotContain(),
            new DelimeterPattern('(cd|\|)'),
            new ShellSinglelineCommentPattern(),
        ];
    }
}