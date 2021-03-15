<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
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

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## INSTALACION
laravel new cast-app --jet

## me cambio a la carpeta del proyecto y correo esto:
    npm install
    npm run dev

## Crear la base de datos en phpmyadmin con el nombre que viene en el archivo .env
## Luego creo las migraciones

php artisan migrate

php artisan make:model Bodega -m
php artisan make:model Categoria -m
php artisan make:model Modelo -m
php artisan make:model Linea -m
php artisan make:model Talla -m
php artisan make:model Marca -m
php artisan make:model Color -m
php artisan make:model Producto -m
php artisan make:model Tallaje -m

## Luego vuelvo a generar las migraciones
php artisan migrate

## en los modelos hago las relaciones

## luego creo un componente de livewire
php artisan make:livewire navigation

## para crear un controlador con sus 7 metodos
php artisan make:controller BodegaController -r
php artisan make:controller CategoriaController -r
php artisan make:controller ColorController -r
php artisan make:controller LineaController -r
php artisan make:controller MarcaController -r
php artisan make:controller ModeloController -r
php artisan make:controller TallaController -r
php artisan make:controller ProductoController -r
php artisan make:controller TallajeController -r

## laravel Collective para los formularios
composer require laravelcollective/html

## Crear componente de livewire
php artisan make:livewire bodega\BodegaIndex
php artisan make:livewire categoria\CategoriaIndex
php artisan make:livewire color\ColorIndex
php artisan make:livewire linea\LineaIndex
php artisan make:livewire marca\MarcaIndex
php artisan make:livewire modelo\ModeloIndex
php artisan make:livewire talla\TallaIndex
php artisan make:livewire producto\ProductoIndex

## para instalar codigo de barras
composer require milon/barcode
