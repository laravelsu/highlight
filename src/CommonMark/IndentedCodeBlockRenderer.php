<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\CommonMark;

use InvalidArgumentException;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use Tempest\Highlight\Highlighter;
use Tempest\Highlight\WebTheme;

final class IndentedCodeBlockRenderer implements NodeRendererInterface
{
    public function __construct(
        private ?Highlighter $highlighter = new Highlighter(),
    ) {
    }

    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        if (! $node instanceof IndentedCode) {
            throw new InvalidArgumentException('Block must be instance of ' . IndentedCode::class);
        }
        
        $highlighter = $this->highlighter;

        $language = 'php';

        $parsed = $highlighter->parse($node->getLiteral(), $language);

        $theme = $highlighter->getTheme();

        if ($theme instanceof WebTheme) {
            return $theme->preBefore($highlighter) . $parsed . $theme->preAfter($highlighter);
        } else {
            return '<pre data-lang="' . $language . '" class="notranslate">' . $parsed . '</pre>';
        }
    }
}
