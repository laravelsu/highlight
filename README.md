# Highlight

PHP-пакет для подсветки синтаксиса кода для проектов [laravel.su](https://laravel.su), основанный на библиотеке Tempest.

## Установка

Для установки пакета используйте [Composer](https://getcomposer.org/):

```bash
composer require laravelsu/highlight
```

## Использование

Простой пример использования для `league/commonmark`:

```php
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;

use Laravelsu\Highlight\CommonMark\HighlightExtension;

$environment = new Environment();

$environment
    ->addExtension(new CommonMarkCoreExtension())
    ->addExtension(new HighlightExtension());

$markdown = new MarkdownConverter($environment);
```

### Примеры CSS

Стили для подсветки синтаксиса находятся в директории `css`. 
Вы можете скопировать их как есть или настроить под свои нужды.

### Использование инлайновых стилей

Если требуется вставлять стили непосредственно в HTML, например `style="color:#000""` вместо css классов.
Для этого укажите путь к CSS-файлу при создании расширения:

```php
$themePath = '/highlight/light.css'

$environment
    ->addExtension(new CommonMarkCoreExtension())
    ->addExtension(new HighlightExtension($themePath));
```