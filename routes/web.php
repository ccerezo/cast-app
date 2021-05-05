<?php

use App\Http\Controllers\BodegaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\EstadoFacturaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\InventarioMateriaPrimaController;
use App\Http\Controllers\LineaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\MateriaPrimaController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\PagoFacturaController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\TallajeController;
use App\Http\Controllers\TipoClienteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('bodegas', BodegaController::class)->names('bodegas')->middleware('auth');

Route::resource('categorias', CategoriaController::class)->names('categorias')->middleware('auth');

Route::resource('colors', ColorController::class)->names('colors')->middleware('auth');

Route::resource('lineas', LineaController::class)->names('lineas')->middleware('auth');

Route::resource('marcas', MarcaController::class)->names('marcas')->middleware('auth');

Route::resource('modelos', ModeloController::class)->names('modelos')->middleware('auth');

Route::resource('tallas', TallaController::class)->names('tallas')->middleware('auth');

Route::resource('tallajes', TallajeController::class)->names('tallajes')->middleware('auth');

Route::resource('productos', ProductoController::class)->names('productos')->middleware('auth');

Route::resource('tipoClientes', TipoClienteController::class)->names('tipoClientes')->middleware('auth');

Route::resource('clientes', ClienteController::class)->names('clientes')->middleware('auth');

Route::resource('estadoFacturas', EstadoFacturaController::class)->names('estadoFacturas')->middleware('auth');

Route::resource('inventarios', InventarioController::class)->names('inventarios')->middleware('auth');

Route::resource('facturas', FacturaController::class)->names('facturas')->middleware('auth');

Route::resource('metodoPagos', MetodoPagoController::class)->names('metodoPagos')->middleware('auth');

Route::resource('pagoFacturas', PagoFacturaController::class)->names('pagoFacturas')->middleware('auth');

Route::resource('proveedors', ProveedorController::class)->names('proveedors')->middleware('auth');

Route::resource('materiaPrimas', MateriaPrimaController::class)->names('materiaPrimas')->middleware('auth');

Route::resource('inventarioMateriaPrimas', InventarioMateriaPrimaController::class)->names('inventarioMateriaPrimas')->middleware('auth');

Route::get('reportes', [PDFController::class, 'index'])->name('reporte.index');
Route::get('pdf/preview', [PDFController::class, 'preview'])->name('pdf.preview');
Route::get('pdf/generate/{id}', [PDFController::class, 'generatePDF'])->name('pdf.generate')->middleware('auth');
Route::get('pdf/generateComprobantePago/{id}', [PDFController::class, 'generateComprobantePagoPDF'])->name('pdf.generateComprobantePago')->middleware('auth');
Route::get('pdf/ventas/mensual/{anio}/{mes}', [PDFController::class, 'reporteMensualPDF'])->name('pdf.reporteMensualPDF')->middleware('auth');
Route::get('pdf/ventas/por-precios/{desde}/{hasta}', [PDFController::class, 'reportePorPrecioPDF'])->name('pdf.reportePorPrecioPDF')->middleware('auth');
Route::get('pdf/ventas/productos/{desde}/{hasta}', [PDFController::class, 'reportePorProductosPDF'])->name('pdf.reportePorProductosPDF')->middleware('auth');
Route::get('pdf/ventas/lo-mas-vendido/{desde}/{hasta}', [PDFController::class, 'reporteLoMasVendidoPDF'])->name('pdf.reporteLoMasVendidoPDF')->middleware('auth');
