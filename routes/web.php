<?php

use App\Http\Controllers\panel\CategoryController;
use App\Http\Controllers\panel\ClientController;
use App\Http\Controllers\panel\CustomerController;
use App\Http\Controllers\panel\MembershipController;
use App\Http\Controllers\panel\DashboardController;
use App\Http\Controllers\panel\ManufacturerController;
use App\Http\Controllers\panel\OptionController;
use App\Http\Controllers\panel\ProductController;
use App\Http\Controllers\panel\TargetMarketController;
use App\Http\Controllers\panel\TaxClassController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {return redirect()->route('home');});


Route::prefix('panel')->middleware(['auth','CheckAdmin'])->group(function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard.index');
    });
    Route::controller(ClientController::class)->group(function () {
        Route::get('/client', 'index')->name('client.panel');
        Route::get('/clientdata', 'indexJson')->name('clientdata.panel');
        Route::delete('/client/{client}', 'destroy')->name('client.delete');
        Route::post('/clientrevoke/{client}', 'revoke')->name('client.revoke');
        Route::post('/clientaccess/{client}', 'access')->name('client.access');
        Route::get('/client/{client}', 'edit')->name('client.edit');
        Route::post('/client', 'store')->name('client.store');
        Route::put('/client/{client}', 'update')->name('client.update');

    });

    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customerlist', 'index')->name('customer.panel');
        Route::get('/customerdata', 'indexJson')->name('customerdata.panel');
        Route::get('/customerdata/{user}', 'edit')->name('customerdata.edit');
        Route::delete('/customerdata/{user}', 'destroy')->name('customerdata.delete');
        Route::post('/customerdata/deleteall', 'destroyAll')->name('customerdata.deleteall');
        Route::post('/customerlist', 'store')->name('customer.store');

    });
    Route::controller(TargetMarketController::class)->group(function () {
        Route::get('/customergroups', 'index')->name('customergroups.panel');
        Route::get('/customergroupsjson', 'indexJson')->name('customergroups.json');
        Route::get('/customergroup/{targetmarket}', 'edit')->name('customergroups.edit');
        Route::delete('/customergroup/{targetmarket}', 'destroy')->name('customergroups.delete');
        Route::post('/customergroups', 'store')->name('customergroups.store');
        Route::put('/customergroup/{targetmarket}', 'update')->name('customergroups.update');
        Route::put('/customergroup/status/{targetmarket}', 'statusupdate')->name('customergroups.statusupdate');
        Route::post('/customergroups/deleteall', 'destroyAll')->name('customergroups.deleteall');

    });
    Route::controller(ManufacturerController::class)->group(function () {
        Route::get('/manufacturers', 'index')->name('manufacturers.panel');
        Route::get('/manufacturersjson', 'indexJson')->name('manufacturers.json');
        Route::get('/manufacturer/{manufacturer}', 'edit')->name('manufacturers.edit');
        Route::delete('/manufacturer/{manufacturer}', 'destroy')->name('manufacturers.delete');
        Route::post('/manufacturers', 'store')->name('manufacturers.store');
        Route::put('/manufacturer/{manufacturer}', 'update')->name('manufacturers.update');
        Route::put('/manufacturer/status/{manufacturer}', 'statusupdate')->name('manufacturers.statusupdate');
        Route::post('/manufacturers/deleteall', 'destroyAll')->name('manufacturers.deleteall');

    });

    Route::controller(TaxClassController::class)->group(function () {
        Route::get('/taxclasses', 'index')->name('taxclasses.panel');
        Route::get('/taxclassesjson', 'indexJson')->name('taxclasses.json');
        Route::get('/taxclass/{taxclass}', 'edit')->name('taxclasses.edit');
        Route::delete('/taxclass/{taxclass}', 'destroy')->name('taxclasses.delete');
        Route::post('/taxclasses', 'store')->name('taxclasses.store');
        Route::put('/taxclass/{taxclass}', 'update')->name('taxclasses.update');
        Route::put('/taxclass/status/{taxclass}', 'statusupdate')->name('taxclasses.statusupdate');
        Route::post('/taxclasses/deleteall', 'destroyAll')->name('taxclasses.deleteall');

    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories.panel');
        Route::get('/categoriesjson', 'create')->name('categories.json');
        Route::get('/category/{category}', 'edit')->name('categories.edit');
        Route::delete('/category/{category}', 'destroy')->name('categories.delete');
        Route::post('/categories', 'store')->name('categories.store');
        Route::put('/category/{category}', 'update')->name('categories.update');
        Route::put('/category/status/{category}', 'statusupdate')->name('categories.statusupdate');
        Route::post('/categories/deleteall', 'destroyAll')->name('categories.deleteall');
        Route::get('/categoriesjson/select', 'show')->name('categories.show');


    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products.panel');
        Route::get('/products/create', 'create')->name('products.create');
        Route::get('/productsjson', 'indexJson')->name('products.json');
        Route::post('/productsjson', 'editJson')->name('products.editjson');
        Route::get('/products/{product}', 'edit')->name('products.edit');
        Route::delete('/products/{product}', 'destroy')->name('products.delete');
        Route::post('/products', 'store')->name('products.store');
        Route::put('/products/{product}', 'update')->name('products.update');
        Route::put('/products/status/{product}', 'statusupdate')->name('products.statusupdate');
        Route::post('/products/deleteall', 'destroyAll')->name('products.deleteall');

    });

    Route::controller(OptionController::class)->group(function () {
        Route::get('/options', 'index')->name('options.panel');
        Route::get('/options/create', 'create')->name('options.create');
        Route::get('/optionsjson', 'indexJson')->name('options.json');
        Route::get('/options/{option}', 'edit')->name('options.edit');
        Route::delete('/options/{option}', 'destroy')->name('options.delete');
        Route::post('/options', 'store')->name('options.store');
        Route::put('/options/{option}', 'update')->name('options.update');
        Route::post('/options/deleteall', 'destroyAll')->name('options.deleteall');

    });

    Route::controller(MembershipController::class)->group(function () {
        Route::get('/membership', 'index')->name('membership.panel');
        Route::get('/membershipdata', 'indexJson')->name('membership.data');
        Route::get('/membership/{user}', 'show')->name('membership.show');
        Route::delete('/membership/{user}', 'destroy')->name('membership.delete');
        Route::put('/membership/{user}', 'update')->name('membership.update');

    });

});


