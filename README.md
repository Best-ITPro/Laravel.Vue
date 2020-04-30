Подробная информация по данному пректу описна в в файле laravel.vue.txt в корне проекта, а так же на на сайте 

http://best-itpro.ru/news/vuejs_laravel7_1/ 


## Предыдущая часть "Работа с Vue.JS в Laravel 7 (часть 1)":

http://best-itpro.ru/news/vuejs_laravel7_1/

https://github.com/Best-ITPro/Laravel.Vue.Blank


Данная часть промежуточная, посвящённая сборке frontend на laravel:

## 18) Сборка фронтенда (Laravel Mix)

Базовая сборка проекта Laravel производится на основе вот этих файлов: 
D:\OSPanel\domains\laravel.vue\resources\js\app.js
D:\OSPanel\domains\laravel.vue\resources\sass\app.scss
к этим файлам мы будем добавлять свои файлы, и файлы подключаемых библиотек (!)

Для простоты реализации в нашем материале "Базовая сборка блога (статьи, категории) на Laravel 7.x" (http://best-itpro.ru/news/laravel7_blog/) мы выкладывали js и css в папку public:
D:\OSPanel\domains\laravel.empty.blog\public\css
D:\OSPanel\domains\laravel.empty.blog\public\js
+ даже сделали дополнительную папку D:\OSPanel\domains\laravel.empty.blog\public\extentions, в которую положили такие отдельные пакеты, как ckeditor и fontawesome-free-5.13.0-web.

Так вот, так делать не надо! Это было сделано для упрощения, и именно так бы мы могли поступить, если бы делали проект, допустим, на чистом PHP, а не на фреймворках подобных Laravel. 

Когда вы делаете нормальный проект, все js, css, sass и прочие файлы должны проходить сборку, и появляться в проекте уже в скомпилированном виде. Для этого и нужна сборка фронтенда (Laravel Mix).

В корне проекта есть файл webpack.mix.js, содержащий строки:
mix.js('resources/js/app.js', 'public/js') 
   .sass('resources/sass/app.scss', 'public/css');

Данные записи означают, что на основе базовых файлов из resources/js/ и resources/sass/ будут собраны файлы в публичной части в папках public/js и public/css.

Собираются одной из следующих команд:

npm run production - данный вариант, как видно из самой команды, собирает исходники уже для продакшн - готового проекта, запущенного в эксплуатацию. Все js, css, sass и прочие файлы будут скомпилированы в сжатом виде (для ускорения загрузки).

npm run dev - файлы компилируются не в сжатом, а в обычном виде, используется при разработке проекта. Если мы вносим какие-то изменения в исходники в папке resources, команду нужно повторить для повторной сборки, и так каждый раз.

npm run watch - данная команда используется при разработке проекта, она продолжит выполняться в терминале и будет следить за всеми изменениями ваших ресурсов. Когда что-либо изменится, автоматически скомпилируются новые файлы. В отличии от предыдущей, запускается один раз и работает, пока вы не остановите.

npm run watch-poll - дополнительный вариант предыдущей команды.

Итак, как же нам добавлять свли файлы и файлы библиотек сторонних разработчиков в свой проект.

CSS - начнем с него. Тут есть 2 варианта:
-----------------------------------------

1) мы все пишем в resources/sass/app.scss, и он уже компилируется в public/css.app.css, который мы подключаем в шаблонах Laravel.
2) мы делаем свой файл, допустим resources/css/style.css и компелируем его в отдельный файл. В таком случае, наш файл webpack.mix.js, будет уже иметь строки:

<code>
mix.js('resources/js/app.js', 'public/js') 
   .sass('resources/sass/app.scss', 'public/css')
   .styles('resources/css/style.css', 'public/css/all.css');
</code>

   
базовый app.sass будет собран в public/css/app.css   
наш style.css в public/css/all.css

Подключение в шаблоне производится командами:


< link href="{{ asset('css/app.css') }}" rel=" stylesheet">
< link href="{{ asset('css/all.css') }}" rel=" stylesheet">


подключение js делается так:


< script src = "{{ asset('js/app.js') }}" defer></ script >


Атрибут defer сообщает браузеру, что он должен продолжать обрабатывать страницу и загружать скрипт в фоновом режиме и запускать его после загрузки страницы, так что неважно, в каком месте шаблона будет подключение js.

Это подключение можно увидеть в файле /resources/views/layouts/app.blade.php нашего исходного кода в репозитории https://github.com/Best-ITPro/Laravel.Vue

JS - файлы скриптов.
--------------------
Общие скрипты можно также писать в resources/js/app.js или в отдельном файле, но тут гораздо более интересный вопрос возникает не со своими скриптами, с бибоиотеками сторонних разработчиков.

В наших предыдущих материалах

http://best-itpro.ru/news/laravel_7/
http://best-itpro.ru/news/laravel7_blog/
http://best-itpro.ru/news/vuejs_laravel7_1/

мы указывали на необходимость использования Node.JS в сборке проектов Larael и описывали способы его установки.

В составе Node.JS идет менеджер пакетов NPM.
Это именно он запускает сборку проекта в предыдущих командах npm run dev или npm run watch

Сайт менеджера https://www.npmjs.com - вводим название библиотеки и видим способ ее установки

Второй вариант - установить дополнительный более быстрый и безопасный менеджер пакетов Yarn
Для установки Yarn в папке проекта надо запустить команды: npm i yarn -g
Проверяем факт установки и версию: yarn -v
как правило эта команда сразу сделает и инициализацию yarn, т.к. в папке пректа уже есть файл package.json, общий для npm и yarn, он содержит описание всех установленных библиотек (пакетов) в проектке.

Более подробно о yarn: https://classic.yarnpkg.com/ru/

Библиотеку стороннего разработчика (пакет), установленную через npm, через yarn устанавливать не надо. Мы ркомендуем использовать yarn и искать пакеты именно на его сайте.

Установка пакетов:

yarn add имя_пакета
или
npm install имя_пакета

Удаление пакетов:

yarn remove имя_пакета
или
npm uninstall имя_пакета 

Подключение пакета в проект (!)
---------------------------
Пакет мало установить - его еще нужно и подключить в проект. 

Все пакеты необходимые дополнительные пакеты, которые мы устанавливаем в проекте, необходимо подключать в файл:
resources/js/bootstrap.js командой require('имя_пакета');

сам bootstrap.js подключается в свою очередь в resources/js/app.js

С файлом bootstrap.js есть одна хитрость - дело в том, что многие пакеты (библиотеки) используют в своей работе самую известную библиотеку js - jquery. Причем они должны подключаться уже после подключения jquery в проект.

Для этого в bootstrap.js есть секция:

<code>
try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}
</code>

вот именно сюда и надо подключать библиотеки подобного типа.

Для примера и закрепления всего вышесказанного рассмотрим подключение в проект известного слайдера OwlCarousel, использование которого в Laravel часто вызывает трудности.

Как подключить OwlCarousel в Laravel.

На сайте yarn в поисковике набираем имя пакета owlcarousel и находим его описание на странице 
https://classic.yarnpkg.com/ru/package/owl.carousel

Как сказано на данной странице, для установки пакета используем команду: yarn add owl.carousel
(в это npm будет команда: npm i owl-carousel)

После этого добавляем подключение OwlCarousel в bootstrap.js:


<code>
try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
    require('owl.carousel');
} catch (e) {}
</code>


В файл resources/js/app.js добавляем секцию:


<code>
import $ from 'jquery';

$(document).ready(function(){

    $('.owl-carousel').owlCarousel({
        items: 1,
        URLhashListener: true,
        mouseDrag: false
    });
});
</code>

Также в соответствии с документацией на https://owlcarousel2.github.io/OwlCarousel2/docs/started-installation.html 
нам надо подключить файлы стилей:

<code>
<link rel="stylesheet" href="owlcarousel/owl.carousel.min.css">
<link rel="stylesheet" href="owlcarousel/owl.theme.default.min.css">
</code>

копируем эти файлы из состава дистриутива в папку resources/css/ и модифицируем файл webpack.mix.js следующим образом:

<code>
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
    .styles([
        'resources/css/style.css',
        'resources/css/owl.carousel/owl.carousel.min.css',
        'resources/css/owl.carousel/owl.theme.default.min.css'
    ], 'public/css/all.css');

</code>

Очищаем кеш: php artisan config:cache

Компилируем проект: npm run dev

и наслаждаемся результатом: http://vue.best-itpro.ru

Исходный код к данному примеру можно увидеть в нашем репозитории: 
https://github.com/Best-ITPro/Laravel.Vue


Как развернуть проект на Laravel.

Чтобы развернуть у себя проект на Larael, полученный из репозитория, авполните ряд действий, описанных в нашей публикации:

"Базовая сборка блога (статьи, категории) на Laravel 7.x"

http://best-itpro.ru/news/laravel7_blog/




;)




<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)
- [Appoly](https://www.appoly.co.uk)
- [OP.GG](https://op.gg)
- [云软科技](http://www.yunruan.ltd/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
