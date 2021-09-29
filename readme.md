#  wp-webpack

Theme for WordPress using WebPack

![wp-webpack](https://www.makedo.net/wp-content/uploads/2019/02/wpandwp.png)

* [Popups](https://github.com/spl1t/wp-webpack#%D0%BF%D0%BE%D0%BF%D0%B0%D0%BF%D1%8B)
* [Forms](https://github.com/spl1t/wp-webpack#%D0%BF%D0%BE%D0%BF%D0%B0%D0%BF%D1%8B)

#  Popups
**Попап с сообщением**  
     ```HTML
     <button class="popup-message button-black xl-button" data-title="Заголовок попапчика" data-text="Какой то текст">Попап с сообщением</button>
     ```
**Попап с формой**  
    ```HTML
    <button class="popup-form button-white xl-button" data-title="Заголовок попапчика" data-text="Какой то текст">Попап с формой</button>
    ```
**Попап для медиафайлов**  
    ```HTML
    <img class="popup-media lazy-img" data-src="http://wp-webpack/wp-content/uploads/2021/09/1.webp" alt="">
    ```


#  Forms
**Функция вызова формы**  
    ```PHP
    echo get_form(['name', 'phone', textarea], 'hero', 'Отправить'); 
    ```





