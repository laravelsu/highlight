<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\CommonMark;

use Laravelsu\Highlight\Languages\Blade\BladeLanguage;
use Laravelsu\Highlight\Languages\ExtendedCss\ExtendedCssLanguage;
use Laravelsu\Highlight\Languages\Html\HtmlLanguage;
use Laravelsu\Highlight\Languages\Ini\IniLanguage;
use Laravelsu\Highlight\Languages\JavaScript\JavaScriptLanguage;
use Laravelsu\Highlight\Languages\Json\JsonLanguage;
use Laravelsu\Highlight\Languages\Nginx\NginxLanguage;
use Laravelsu\Highlight\Languages\Php\PhpLanguage;
use Laravelsu\Highlight\Languages\Shell\ShellLanguage;
use Laravelsu\Highlight\Languages\Sql\SqlLanguage;
use Laravelsu\Highlight\Languages\Vue\VueLanguage;
use Laravelsu\Highlight\Languages\Xml\XmlLanguage;
use Laravelsu\Highlight\Languages\Yaml\YamlLanguage;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Extension\ExtensionInterface;
use Tempest\Highlight\Highlighter;
use Laravelsu\Highlight\Themes\CssTheme;
use Laravelsu\Highlight\Themes\InlineTheme;

/**
 * Extension for adding syntax highlighting to CommonMark.
 */
final class HighlightExtension implements ExtensionInterface
{
    /**
     * @var Highlighter Handles syntax highlighting for code blocks.
     */
    private Highlighter $highlighter;

    /**
     * HighlightExtension constructor.
     *
     * @param string|null $themePath Optional path to an inline theme file.
     */
    public function __construct(?string $themePath = null)
    {
        $theme = $themePath
            ? new InlineTheme($themePath)
            : new CssTheme;

        $this->highlighter = new Highlighter($theme);

        foreach ($this->getSupportedLanguages() as $language) {
            $this->highlighter->addLanguage($language);
        }
    }

    /**
     * Returns the list of supported languages for syntax highlighting.
     *
     * @return array<\Tempest\Highlight\Language> An array of language instances.
     */
    private function getSupportedLanguages(): array
    {
        return [
            new PhpLanguage,
            new ShellLanguage,
            new IniLanguage,
            new BladeLanguage,
            new VueLanguage,
            new NginxLanguage,
            new JavaScriptLanguage,
            new HtmlLanguage,
            new XmlLanguage,
            new JsonLanguage,
            new SqlLanguage,
            new YamlLanguage,
            new ExtendedCssLanguage,
        ];
    }

    /**
     * Registers the extension with the environment.
     *
     * @param EnvironmentBuilderInterface $environment The environment builder instance.
     */
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment
            ->addRenderer(FencedCode::class, new CodeBlockRenderer($this->highlighter), 10)
            ->addRenderer(IndentedCode::class, new IndentedCodeBlockRenderer($this->highlighter), 10);
    }
}
