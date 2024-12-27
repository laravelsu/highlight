<?php

namespace Laravelsu\Highlight\CommonMark;

use InvalidArgumentException;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use Tempest\Highlight\Highlighter;
use Tempest\Highlight\WebTheme;

final class CodeBlockRenderer implements NodeRendererInterface
{
    public function __construct(
        private Highlighter $highlighter,
        private string $defaultLanguage = 'php'
    ) {}

    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        if (! $node instanceof FencedCode) {
            throw new InvalidArgumentException('Block must be instance of '.FencedCode::class);
        }

        preg_match('/^(?<language>[\w]+)(\{(?<startAt>[\d]+)\})?/', $node->getInfoWords()[0] ?? 'txt', $matches);

        $highlighter = $this->highlighter;

        if ($startAt = ($matches['startAt']) ?? null) {
            $highlighter = $highlighter->withGutter((int) $startAt);
        }

        $language = $matches['language'] ?? $this->defaultLanguage;

        $parsed = $highlighter->parse($node->getLiteral(), $language);

        $theme = $highlighter->getTheme();

        if ($theme instanceof WebTheme) {
            return $theme->preBefore($highlighter).$parsed.$theme->preAfter($highlighter);
        }

        return sprintf(
            '<pre><code data-lang="%s" class="notranslate">%s</code></pre>',
            $language,
            $parsed
        );
    }
}
