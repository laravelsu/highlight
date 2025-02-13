<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\Languages\CustomBase\Injections;

use Tempest\Highlight\After;
use Tempest\Highlight\Escape;
use Tempest\Highlight\Highlighter;
use Tempest\Highlight\Injection;
use Tempest\Highlight\ParsedInjection;
use Tempest\Highlight\Tokens\DynamicTokenType;

#[After]
final readonly class CustDeletionInjection implements Injection
{
    public function parse(string $content, Highlighter $highlighter): ParsedInjection
    {
        // Standardize line endings
        $content = preg_replace('/\R/u', PHP_EOL, $content);

        $content = str_replace('❷span class=❹ignore❹❸{-❷/span❸', '{-', $content);
        $content = str_replace('❷span class=❹ignore❹❸-}❷/span❸', '-}', $content);

        preg_match_all('/([^{]|^)(\{-)((.|\n)*?)(-})/', $content, $matches, PREG_OFFSET_CAPTURE);

        $parsedOffset = 0;

        foreach ($matches[0] as $match) {
            $matchedContent = $match[0];
            $offset = $match[1];

            $theme = $highlighter->getTheme();
            $open = Escape::tokens($theme->before(new DynamicTokenType('hl-deletion')));
            $close = Escape::tokens($theme->after(new DynamicTokenType('hl-deletion')));

            // Replace tags + EOLs with appropriate span tags
            $parsedMatchedContent = str_replace(
                ['{-', PHP_EOL, '-}'],
                [$open, $close . PHP_EOL . $open, $close],
                $matchedContent,
            );

            // Inject the parsed match into the content
            $content = str_replace($matchedContent, $parsedMatchedContent, $content);

            // Configure the gutter,
            if ($gutter = $highlighter->getGutterInjection()) {
                $startingLineNumber = substr_count(
                    haystack: $content,
                    needle: PHP_EOL,
                    length: $offset + $parsedOffset,
                ) + 1;

                $totalAmountOfLines = substr_count(
                    haystack: $parsedMatchedContent,
                    needle: PHP_EOL,
                ) + 1;

                for ($lineNumber = $startingLineNumber; $lineNumber < $startingLineNumber + $totalAmountOfLines; $lineNumber++) {
                    $gutter
                        ->addIcon($lineNumber, '-')
                        ->addClass($lineNumber, 'hl-gutter-deletion');
                }
            }

            $parsedOffset += strlen($open) + strlen($close);
        }

        return new ParsedInjection($content);
    }
}
