#  WordPack theme
WordPress theme compiled by WepPack

![wp-webpack](https://github.com/spl1t/wp-webpack/blob/master/screenshot.png?raw=true)

**Инструкции к теме:**
* [Start](https://github.com/spl1t/wp-webpack#start)
* [Header](https://github.com/spl1t/wp-webpack#header)
* [Popups](https://github.com/spl1t/wp-webpack#modal-windows)
* [Forms](https://github.com/spl1t/wp-webpack#forms)
* [WebP image](https://github.com/spl1t/wp-webpack#webp-image)
* [SEO](https://github.com/spl1t/wp-webpack#seo)
* [Настройки темы](https://github.com/spl1t/wp-webpack#setting-theme)

[Demo page](https://github.com/spl1t/wp-webpack/blob/master/page-home.php)

## Start

Install theme
```text
git clone https://github.com/spl1t/wordpack.git
cd wordpack
npm i
exit
```

Start dev
```
npm run watch
```

Build prod
```
npm run build
```

##  Header
**Липкая шапка**

Добавить класс для header `sticky-header`

##  Modal windows
Для начала в дериктории template-parts/modals/ нужно создать хотя бы одно модальное окно, важно что бы id модалки повторял название файла `id="modal-%FILE-NAME%"`
```html
<?php
$condition_type = $args['condition_type'];
?>

<div id="modal-example" class="modal <?php echo $condition_type; ?>">
    <div class="modal-inner">
        <div class="modal__body">
            <div class="modal__close">x</div>
            <h6 class="modal__title">Example modal</h6>
            <p class="modal__text">Hello world</p>
        </div>
    </div>
</div>
```
**Вызов модалки по клику**

У элемента должен быть специальный атрибут `data-modal="%FILE-NAME%"`, где %FILE-NAME% подставляем название файла необходимого модального окна из template-parts/modals/

Это применимо почти ко всем HTML тегам.
```html
<button class="button-white" data-modal="example">Попап с формой</button>
```

**Вызов модалки по условию**

Прописывается в файле функции по адресу `/includes/modals/functions`

condition_type может принимать одно из значений:
* delay_50 //время задержки показа в сенкудах ОТ 0 ДО БЕСКОНЕЧНОСТИ
* scroll_80 //показ модалки при достижении прокрутки страницы в процентах ОТ 0 ДО 100

```php
function modal_for_front_page() {
    if (is_front_page()) {
        get_template_part('template-parts/modals/order', '', ['condition_type' => 'delay_ВРЕМЯ_ЗАДЕРЖКИ_В_СЕКУНДАХ']);
    }
}
add_action('modal_display_hook', 'modal_for_front_page');
```

##  Forms
В дериктории `/template-parts/forms/` хранятся формы, также там есть демо файл `example.php` формы со всеми возможными полями.
Для того что бы вызвать нужную форму используется функция `get_template_parts`
```php
<?php get_template_part('/template-parts/forms/hero') ?>
```

##  WebP image
Тема поддерживает WebP изображения, при загрузке изображения в библиотеку срабатывает конвертация изображения в WebP.
Для удобства вставки WebP изображений лучше использовать специальные функции.
```php
getImageByID($id, $class);
getImageByUrl($url, $class);
```

##  SEO
На каждой странице, услуге, записи в режиме редактирования доступна группа полей что бы задать кастомные значения для SEO тегов.
Правила и шаблоны формирования SEO тегов находятся в файле `/includes/SEO/functions.php`

##  Theme setting
На странице настроек темы можно прописать глобальные значения такие как телефон, email и тд.
На странице оптимизация темы можно включить/отключить некторые функции темы/wordpress






