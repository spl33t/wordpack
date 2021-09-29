#  wp-webpack

Theme for WordPress using WebPack

![wp-webpack](https://www.makedo.net/wp-content/uploads/2019/02/wpandwp.png)

* [Popups](https://github.com/spl1t/wp-webpack#popups)
* [Forms](https://github.com/spl1t/wp-webpack#forms)

##  Popups

**Попап с сообщением**  

     ```html
     <button class="popup-message button-black xl-button" data-title="Заголовок попапчика" data-text="Какой то текст">Попап с сообщением</button>
     ```

**Попап с формой**  

    ```html
    <button class="popup-form button-white xl-button" data-title="Заголовок попапчика" data-text="Какой то текст">Попап с формой</button>
    ```
**Попап для медиафайлов**  

    ```html
    <img class="popup-media lazy-img" data-src="http://wp-webpack/wp-content/uploads/2021/09/1.webp" alt="">
    ```


##  Forms

**Функция вызова формы**  
    ```php
    echo get_form(['name', 'phone', textarea], 'hero', 'Отправить'); 
    ```





