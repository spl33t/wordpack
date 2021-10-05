#  WordPack theme
<p>Wordpress theme compiled by Wepback</p>

## Start

Paste code to terminal, the result will be installation last version Wordpress and WordPack theme

```
cd C:\localserver\OSPanel\domains
git clone git://core.git.wordpress.org/ project_name
cd project_name
RMDIR .git
cd wp-content
RMDIR themes /S /Q
mkdir themes
cd themes
git clone https://github.com/spl1t/wp-webpack.git
cd C:\localserver\OSPanel\domains
rename C:\localserver\OSPanel\domains\project_name project_true
```

![wp-webpack](https://github.com/spl1t/wp-webpack/blob/master/screenshot.png?raw=true)

**Инструкции к теме:**

* [Header](https://github.com/spl1t/wp-webpack#header)
* [Popups](https://github.com/spl1t/wp-webpack#popups)
* [Forms](https://github.com/spl1t/wp-webpack#forms)
* [Demo page](https://github.com/spl1t/wp-webpack/blob/master/page-home.php)

##  Header

**Липкая шапка**

Добавить класс для header `sticky-header`

##  Popups

**Попап с сообщением**  

```html
<button class="popup-message button-black xl-button" data-title="Заголовок попапчика" data-text="Какой то текст">Попап с сообщением</button>
```

**Попап с формой**  

```html
<button class="popup-form button-white xl-button" data-title="Заголовок попапчика" data-text="Какой то текст">Попап с формой</button>
```

**Попап и для lazyload для медиафайлов**  

```html
<img class="popup-media lazy-img" data-src="http://wp-webpack/wp-content/uploads/2021/09/1.webp" alt="">
```


##  Forms

**Функция вызова формы**  

arg: name, phone, letter 

```php
<?php echo get_form(['name', 'phone',], 'hero', 'Отправить');  ?>
```







