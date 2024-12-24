<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\Php\Injections;

use Tempest\Highlight\Highlighter;
use Tempest\Highlight\Injection;
use Tempest\Highlight\IsInjection;
use Tempest\Highlight\Escape;
use Tempest\Highlight\Tokens\DynamicTokenType;
use Laravelsu\Highlight\Languages\Php\PhpConst;

final readonly class PhpDocCommentReturnTypeInjection implements Injection
{
    use IsInjection;

    public function getPattern(): string
    {
        return '\@(return|throws|var|extends)(\s)+(?<match>.*?)(\*\/|$|\R)';
    }

    public function parseContent(string $content, Highlighter $highlighter): string
    {
        $keywords = PhpConst::PHP_TYPES;
        
        $types = preg_match_all('/(?!([\w]+)\\\\)(?<match>[\w]+)/', $content, $matches);
        
        $theme = $highlighter->getTheme();
        
        if (key_exists('match', $matches))
        {
            foreach($matches['match'] as $type)
            {
                $token = (in_array($type, $keywords)) ? 'hl-keyword' : 'hl-type';

                $content = preg_replace(
                    '/\b' . $type . '[\b]*/',
                    Escape::tokens($theme->before(new DynamicTokenType($token)))
                    . $type
                    . Escape::tokens($theme->after(new DynamicTokenType($token))),
                    $content,
                );
            }
        }

        return $content;
    }
}
