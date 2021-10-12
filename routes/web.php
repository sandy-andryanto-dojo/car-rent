<?php

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
Route::group(['middleware' => ['XSS']], function ($router) {

    Auth::routes();

    Route::get('verify/{token}', '\App\Http\Controllers\Auth\RegisterController@verify')->name('account.verify');

    Route::get('/rebuild', function () {
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        if (isset($_SERVER['HTTP_HOST'])) {
            $root = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
            $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
            return "<script> window.location.href = '" . $root . "'; </script>";
        }
    })->name('app.rebuild');

});

Route::group(['middleware' => ['SessionTimeout', 'XSS', 'auth']], function ($router) {

    Route::get('/', function () {
        $user = \Auth::user();
        if ($user->can("view_dashboards")) {
            return redirect()->route('dashboards.index');
        } else {
            return redirect()->route('profiles.index');
        }
    })->name("home");

    Route::get('/home', function () {
        return redirect()->route('home');
    });

    Route::resource('dashboards', '\App\Http\Controllers\Main\DashboardController');
    Route::resource('profiles', '\App\Http\Controllers\Main\ProfileController');

    Route::group(['prefix' => 'reference'], function () {
        Route::resource('banks', '\App\Http\Controllers\Main\Reference\BankController');
        Route::resource('identities', '\App\Http\Controllers\Main\Reference\IdentityController');
        Route::resource('fuels', '\App\Http\Controllers\Main\Reference\FuelController');
        Route::resource('services', '\App\Http\Controllers\Main\Reference\ServiceController');
        Route::resource('status', '\App\Http\Controllers\Main\Reference\StatusController');
        Route::resource('drivers', '\App\Http\Controllers\Main\Reference\DriverController');
    });

    Route::group(['prefix' => 'customer'], function () {
        Route::resource('persons', '\App\Http\Controllers\Main\Customer\PersonController');
        Route::resource('customer_contacts', '\App\Http\Controllers\Main\Customer\CustomerContactController');
        Route::resource('customer_files', '\App\Http\Controllers\Main\Customer\CustomerFileController');
    });

    Route::group(['prefix' => 'car'], function () {
        Route::resource('brands', '\App\Http\Controllers\Main\Car\BrandController');
        Route::resource('types', '\App\Http\Controllers\Main\Car\TypeController');
        Route::resource('models', '\App\Http\Controllers\Main\Car\ModelController');
        Route::resource('vehicles', '\App\Http\Controllers\Main\Car\VehicleController');
        Route::resource('car_penalties', '\App\Http\Controllers\Main\Car\CarPenaltyController');
        Route::resource('car_images', '\App\Http\Controllers\Main\Car\CarImageController');
    });

    Route::group(['prefix' => 'transaction'], function () {
        Route::resource('orders', '\App\Http\Controllers\Main\Transaction\OrderController');
        Route::resource('purchases', '\App\Http\Controllers\Main\Transaction\PurchaseController');
        Route::get('invoice_loader', '\App\Http\Controllers\Main\Transaction\InvoiceController@previewLoader')->name("invoice.loader");
    });

    Route::group(['prefix' => 'setting'], function () {
        Route::resource('settings', '\App\Http\Controllers\Main\Setting\SettingController');
        Route::resource('audits', '\App\Http\Controllers\Main\Setting\AuditController');
        Route::resource('users', '\App\Http\Controllers\Main\Setting\UserController');
        Route::resource('roles', '\App\Http\Controllers\Main\Setting\RoleController');
    });


});
