<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\ContainerTypeController;
use App\Http\Controllers\DamageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DespatchController;
use App\Http\Controllers\DevolutionController;
use App\Http\Controllers\DischargueController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReeferConditionController;
use App\Http\Controllers\ReeferTechnologyController;
use App\Http\Controllers\ShippingLineController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoidedController;
use App\Http\Controllers\VoucherController;
use App\Http\Middleware\CheckCompanySelected;
use App\Models\Invoice;
use App\Models\ReeferCondition;
use App\Models\Vessel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Str;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::redirect('/', '/dashboard');

Route::middleware([
    'auth',
])->group(function () {

    Route::middleware([
        CheckCompanySelected::class
    ])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index',])->name('dashboard');
        //Ventas
        Route::get('vouchers', [VoucherController::class, 'index',])->name('vouchers.index');
        Route::get('vouchers/invoice', [VoucherController::class, 'invoice',])->name('vouchers.invoice');
        Route::get('vouchers/note', [VoucherController::class, 'note',])->name('vouchers.note');
        Route::get('vouchers/{invoice}', [VoucherController::class, 'show',])->name('vouchers.show');


        Route::get('voideds', [VoidedController::class, 'index',])->name('voideds.index');

        Route::get('despatchs', [DespatchController::class, 'index',])->name('despatchs.index');
        Route::get('despatchs/create', [DespatchController::class, 'create',])->name('despatchs.create');

        Route::resource('clients', ClientController::class);

        //Inventario
        Route::get('products', [ProductController::class, 'index',])->name('products.index');

        Route::get('companies/edit', [CompanyController::class, 'edit',])->name('companies.edit');
        Route::put('companies/update', [CompanyController::class, 'update',])->name('companies.update');
        Route::get('companies/api-token', [CompanyController::class, 'apiToken',])->name('companies.api-token');
        Route::delete('companies', [CompanyController::class, 'destroy',])->name('companies.destroy');

        Route::resource('branches', BranchController::class)
            ->except('update');
        Route::get('branches-choose', [BranchController::class, 'choose',])->name('branches.choose');
        Route::get('branches/{branch}/series', [BranchController::class, 'series',])->name('branches.series');

        Route::resource('users', UserController::class);

        //maestras para inspecciones
        Route::resource('damages', DamageController::class)->names('damages')->except('show');
        Route::resource('components', ComponentController::class)->names('components')->except('show');
        Route::resource('methods', MethodController::class)->names('methods')->except('show');
        Route::resource('locations', LocationController::class)->names('locations')->except('show');

        //maestras para admisión
        Route::resource('lines', ShippingLineController::class)->names('lines')->except('show');
        Route::get('line/{line}/vessels', [ShippingLineController::class, 'vessels'])->name('line.vessels');
        Route::resource('ports', PortController::class)->names('ports')->except('show');
        Route::resource('container-types', ContainerTypeController::class)->names('container-types')->except('show');
        Route::resource('reefer-technologies', ReeferTechnologyController::class)->names('reefer-technologies')->except('show');
        Route::resource('reefer-conditions', ReeferConditionController::class)->names('reefer-conditions')->except('show');

        //rutas de carga de data de contenedores
        Route::resource('dischargues', DischargueController::class)->names('dischargues')->except('show');
        Route::resource('devolutions', DevolutionController::class)->names('devolutions')->except('show');
        Route::resource('containers', ContainerController::class)->names('containers');
        Route::get('downloads/dischargue-template', function () {
            return response()->download(resource_path('templates/massive_dischargue.xlsx'));
        })->name('dischargue-template');

        //endpoint para selectores
        Route::get('searchLine', [ShippingLineController::class, 'searchLines'])->name('line.search');
        Route::get('searchVessel', [ShippingLineController::class, 'searchVessels'])->name('vessel.search');
    });
});

Route::resource('companies', CompanyController::class)
    ->only(['index', 'create', 'show']);


/* Route::get('documentacion', function () {
    return view('docs');
}); */
