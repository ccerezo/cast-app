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
ULAICJGARCIAH
HNJS94oe4*
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
php artisan make:model TipoCliente -m
php artisan make:model Cliente -m
php artisan make:model EstadoFactura -m
php artisan make:model Vendedor -m
php artisan make:model MetodoPago -m
php artisan make:model Inventario -m
php artisan make:model InventarioDetalle -m
php artisan make:model Factura -m
php artisan make:model FacturaDetalle -m
php artisan make:model pagoFactura -m
php artisan make:model Cupo -m
php artisan make:model Proveedor -m
php artisan make:model MateriaPrima -m
php artisan make:model InventarioMateriaPrima -m
php artisan make:model MateriaPrimaDetalle -m
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
php artisan make:controller TipoClienteController -r
php artisan make:controller ClienteController -r
php artisan make:controller EstadoFacturaController -r
php artisan make:controller VendedorController -r
php artisan make:controller MetodoPagoController -r
php artisan make:controller InventarioController -r
php artisan make:controller FacturaController -r
php artisan make:controller FacturaDetalleController -r
php artisan make:controller PDFController
php artisan make:controller PagoFacturaController -r
php artisan make:controller ProveedorController -r
php artisan make:controller MateriaPrimaController -r
php artisan make:controller InventarioMateriaPrimaController -r

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
php artisan make:livewire producto\ProductoCreate
php artisan make:livewire producto\ProductoEdit
php artisan make:livewire tipoCliente\TipoClienteIndex
php artisan make:livewire cliente\ClienteIndex
php artisan make:livewire cliente\ClienteCreate
php artisan make:livewire cliente\ClienteEdit
php artisan make:livewire estadoFactura\EstadoFacturaIndex
php artisan make:livewire vendedor\VendedorIndex
php artisan make:livewire metodoPago\MetodoPagoIndex
php artisan make:livewire inventario\InventarioIndex
php artisan make:livewire inventario\InventarioDetalle
php artisan make:livewire factura\FacturaIndex
php artisan make:livewire factura\FacturaCreate
php artisan make:livewire factura\FacturaEdit
php artisan make:livewire shared\ClienteSearch
php artisan make:livewire shared\ProductoSearch
php artisan make:livewire pagoFactura\PagoFacturaIndex
php artisan make:livewire reporte\ReporteIndex
php artisan make:livewire proveedor\ProveedorIndex
php artisan make:livewire materiaPrima\MateriaPrimaIndex
php artisan make:livewire inventarioMateriaPrima\InventarioMateriaPrimaIndex
## para instalar codigo de barras
composer require milon/barcode
composer require barryvdh/laravel-dompdf
composer update
## para atributos campos a la tabla
php artisan make:migration add_codigo_to_categorias_table
php artisan make:migration add_codigo_barras_to_productos_table
php artisan migrate

## tipo de codigo de barra
echo DNS1D::getBarcodeHTML('4445645656', 'C39');
echo DNS1D::getBarcodeHTML('4445645656', 'C39+');
echo DNS1D::getBarcodeHTML('4445645656', 'C39E');
echo DNS1D::getBarcodeHTML('4445645656', 'C39E+');
echo DNS1D::getBarcodeHTML('4445645656', 'C93');
echo DNS1D::getBarcodeHTML('4445645656', 'S25');
echo DNS1D::getBarcodeHTML('4445645656', 'S25+');
echo DNS1D::getBarcodeHTML('4445645656', 'I25');
echo DNS1D::getBarcodeHTML('4445645656', 'I25+');
echo DNS1D::getBarcodeHTML('4445645656', 'C128');
echo DNS1D::getBarcodeHTML('4445645656', 'C128A');
echo DNS1D::getBarcodeHTML('4445645656', 'C128B');
echo DNS1D::getBarcodeHTML('4445645656', 'C128C');
echo DNS1D::getBarcodeHTML('44455656', 'EAN2');
echo DNS1D::getBarcodeHTML('4445656', 'EAN5');
echo DNS1D::getBarcodeHTML('4445', 'EAN8');
echo DNS1D::getBarcodeHTML('4445', 'EAN13');
echo DNS1D::getBarcodeHTML('4445645656', 'UPCA');
echo DNS1D::getBarcodeHTML('4445645656', 'UPCE');
echo DNS1D::getBarcodeHTML('4445645656', 'MSI');
echo DNS1D::getBarcodeHTML('4445645656', 'MSI+');
echo DNS1D::getBarcodeHTML('4445645656', 'POSTNET');
echo DNS1D::getBarcodeHTML('4445645656', 'PLANET');
echo DNS1D::getBarcodeHTML('4445645656', 'RMS4CC');
echo DNS1D::getBarcodeHTML('4445645656', 'KIX');
echo DNS1D::getBarcodeHTML('4445645656', 'IMB');
echo DNS1D::getBarcodeHTML('4445645656', 'CODABAR');
echo DNS1D::getBarcodeHTML('4445645656', 'CODE11');
echo DNS1D::getBarcodeHTML('4445645656', 'PHARMA');
echo DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T');

DELETE FROM factura_detalles;
DELETE FROM facturas;
DELETE FROM productos;
DELETE FROM inventarios;
DELETE FROM pago_facturas;

ALTER TABLE productos AUTO_INCREMENT = 1;
ALTER TABLE inventarios AUTO_INCREMENT = 1;
ALTER TABLE facturas AUTO_INCREMENT = 1;
ALTER TABLE factura_detalles AUTO_INCREMENT = 1;
ALTER TABLE pago_facturas AUTO_INCREMENT = 1;

php artisan make:seeder ClienteSeeder
php artisan make:factory ClienteFactory

php artisan db:seed --class=ClienteSeeder

php artisan livewire:publish --pagination

addInventario
productos
after
insert
BEGIN
    IF NEW.id > 0 THEN
	    INSERT INTO inventarios(entradas, ultima_entrada, salidas, stock, producto_id, created_at)
        VALUES(NEW.stock, NEW.created_at, 0,NEW.stock,NEW.id,NEW.created_at);
    END IF ;
END


actualizarSalidasInventario
factura_detalles
after
insert
BEGIN
	IF NEW.id > 0 THEN
        UPDATE inventarios 
        SET salidas = (salidas + (NEW.cantidad)), stock = (stock - (NEW.cantidad)), ultima_salida = NEW.created_at
        WHERE producto_id = NEW.producto_id;
        UPDATE productos 
        SET stock = (stock - NEW.cantidad) 
        WHERE id = NEW.producto_id;
    END IF ;
END


eliminarInventario
productos
before
delete
BEGIN
    IF OLD.id > 0 THEN
	    DELETE from inventarios WHERE id = OLD.id;
    END IF ;
END

contrl + D reemplazar variables
alt click para escribir varias linea
HASTA AQUI  QUIERO VOLVER

SELECT * FROM productos WHERE modelo_id = 82

UPDATE modelos SET codigo = '102' WHERE id = 79
UPDATE modelos SET codigo = '103' WHERE id = 84
UPDATE modelos SET codigo = '104' WHERE id = 87
UPDATE modelos SET codigo = '105' WHERE id = 100

UPDATE modelos SET codigo = '107' WHERE id = 45

update productos SET codigo_barras = REPLACE(codigo_barras, '001007001', '001007100') WHERE modelo_id = 109

115 DE DEDO LAZO EN CAPELLADA
    CAPELLADA DEDO LAZO
133	TACOS	OFICINA 5 Y MEDIO
    OFICINA 5 1/2

054 BRENDA  ====> 055

The end result was: 10CM X 20CM =

$customPaper = array(0,0,567.00,283.80);
