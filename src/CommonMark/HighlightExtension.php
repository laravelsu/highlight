<?php

declare(strict_types=1);

namespace Laravelsu\Highlight\CommonMark;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Extension\ExtensionInterface;
use Tempest\Highlight\Highlighter;
use Tempest\Highlight\CommonMark\CodeBlockRenderer;

use Laravelsu\Highlight\Languages\Php\PhpLanguage;
use Laravelsu\Highlight\Languages\Shell\ShellLanguage;
use Laravelsu\Highlight\Languages\Ini\IniLanguage;
use Laravelsu\Highlight\Languages\Blade\BladeLanguage;
use Laravelsu\Highlight\Languages\Vue\VueLanguage;
use Laravelsu\Highlight\Languages\Nginx\NginxLanguage;
use Laravelsu\Highlight\Languages\JavaScript\JavaScriptLanguage;
use Laravelsu\Highlight\Languages\Xml\XmlLanguage;
use Laravelsu\Highlight\Languages\Json\JsonLanguage;
use Laravelsu\Highlight\Languages\Sql\SqlLanguage;
use Laravelsu\Highlight\Languages\Yaml\YamlLanguage;
use Laravelsu\Highlight\Languages\ExtendedCss\ExtendedCssLanguage;
use Laravelsu\Highlight\Languages\Html\HtmlLanguage;

final class HighlightExtension implements ExtensionInterface
{
    public function __construct(
        private Highlighter $highlighter = new Highlighter(),  //new InlineTheme(__DIR__ . '/../style.css')),  //   (),
    ) {
        $this->highlighter->addLanguage(new PhpLanguage());
        $this->highlighter->addLanguage(new ShellLanguage());
        $this->highlighter->addLanguage(new IniLanguage());
        $this->highlighter->addLanguage(new BladeLanguage());
        $this->highlighter->addLanguage(new VueLanguage());
        $this->highlighter->addLanguage(new NginxLanguage());
        $this->highlighter->addLanguage(new JavaScriptLanguage());
        $this->highlighter->addLanguage(new HtmlLanguage());
        $this->highlighter->addLanguage(new XmlLanguage());
        $this->highlighter->addLanguage(new JsonLanguage());
        $this->highlighter->addLanguage(new SqlLanguage());
        $this->highlighter->addLanguage(new YamlLanguage());
        $this->highlighter->addLanguage(new ExtendedCssLanguage());
    }

    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment
            ->addRenderer(FencedCode::class, new CodeBlockRenderer($this->highlighter), 10)
            ->addRenderer(IndentedCode::class, new IndentedCodeBlockRenderer($this->highlighter), 10)
        ;
    }
}
