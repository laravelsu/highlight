<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\CustomBase\Injections;

use Tempest\Highlight\Before;
use Tempest\Highlight\Highlighter;
use Tempest\Highlight\Injection;
use Tempest\Highlight\ParsedInjection;

#[Before]
final readonly class TLRemoveMultilineStartInjection implements Injection
{
    public function parse(string $content, Highlighter $highlighter): ParsedInjection
    {
        preg_match_all('/(?<match>(.)*(\/\/|<\!\-\-|#) \[tl\! remove\:start\]( \-\-\>)?)/', $content, $matches, PREG_OFFSET_CAPTURE);

        foreach ($matches['match'] as $match) {
            $matchedContent = $match[0];

            $open = '{+';

            $parsedMatchedContent = $open . str_replace(
                ['// [tl! remove:start]', '<!-- [tl! remove:start] -->', '# [tl! remove:start]'],
                '',
                $matchedContent,
            );

            $content = str_replace($matchedContent, $parsedMatchedContent, $content);
        }

        return new ParsedInjection($content);
    }
}
