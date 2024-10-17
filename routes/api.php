<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register'])->name('api.register');
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->name('api.logout');;
    Route::get('/me', [\App\Http\Controllers\Api\AuthController::class, 'me'])->name('api.me');;
});

Route::middleware('auth:sanctum')->group( function () {
    Route::post('/admin/category/store', [App\Http\Controllers\Admin\Category\CategoryController::class, 'store'])->name('category.store');
    Route::post('/admin/category/update_name', [App\Http\Controllers\Admin\Category\CategoryController::class, 'AjaxEditNameCategory'])->name('category.update_name');
    Route::post('/admin/category/update_logo', [App\Http\Controllers\Admin\Category\CategoryController::class, 'AjaxEditLogoCategory'])->name('category.update_logo');
    Route::post('/admin/category/delete', [App\Http\Controllers\Admin\Category\CategoryController::class, 'AjaxDeleteCategory'])->name('category.delete_name');

    Route::post('/admin/producer/store', [App\Http\Controllers\Admin\Producer\ProducerController::class, 'store'])->name('producer.store');
    Route::post('/admin/producer/update_name', [App\Http\Controllers\Admin\Producer\ProducerController::class, 'AjaxEditNameProducer'])->name('producer.update_name');
    Route::post('/admin/producer/update_logo', [App\Http\Controllers\Admin\Producer\ProducerController::class, 'AjaxEditLogoProducer'])->name('producer.update_logo');
    Route::post('/admin/producer/delete', [App\Http\Controllers\Admin\Producer\ProducerController::class, 'AjaxDeleteProducer'])->name('producer.delete_name');

    Route::post('/admin/attribute/store', [App\Http\Controllers\Admin\Attribute\AttributeController::class, 'store'])->name('attribute.store');
    Route::post('/admin/attribute/update', [App\Http\Controllers\Admin\Attribute\AttributeController::class, 'AjaxEditAttribute'])->name('attribute.update');
    Route::post('/admin/attribute/delete', [App\Http\Controllers\Admin\Attribute\AttributeController::class, 'AjaxDeleteAttribute'])->name('attribute.delete');

    Route::post('/admin/spec/store', [App\Http\Controllers\Admin\AttributeSpec\AttributeSpecController::class, 'store'])->name('attribute-spec.store');
    Route::post('/admin/spec/update', [App\Http\Controllers\Admin\AttributeSpec\AttributeSpecController::class, 'AjaxEditAttributeSpec'])->name('attribute-spec.update');
    Route::post('/admin/spec/delete', [App\Http\Controllers\Admin\AttributeSpec\AttributeSpecController::class, 'AjaxDeleteAttributeSpec'])->name('attribute-spec.delete');

    Route::post('/admin/model/store', [App\Http\Controllers\Admin\ProductModel\ProductModelController::class, 'store'])->name('model.store');
    Route::post('/admin/model/update', [App\Http\Controllers\Admin\ProductModel\ProductModelController::class, 'AjaxEditModel'])->name('model.update');
    Route::post('/admin/model/delete', [App\Http\Controllers\Admin\ProductModel\ProductModelController::class, 'AjaxDeleteModel'])->name('model.delete');
    Route::get('/admin/product-models/{producerId}', [App\Http\Controllers\Admin\ProductModel\ProductModelController::class, 'getProductModels'])->name('model.get-by-producer');


    Route::post('/admin/status/store', [App\Http\Controllers\Admin\Status\StatusController::class, 'store'])->name('status.store');
    Route::post('/admin/status/update', [App\Http\Controllers\Admin\Status\StatusController::class, 'AjaxEditStatus'])->name('status.update');
    Route::post('/admin/status/delete', [App\Http\Controllers\Admin\Status\StatusController::class, 'AjaxDeleteStatus'])->name('status.delete');

    Route::get('/admin/product/get-attribute', [App\Http\Controllers\Admin\Product\ProductController::class, 'AjaxGetAttributes'])->name('api.get-attribute');
    Route::post('/admin/product/store', [App\Http\Controllers\Admin\Product\ProductController::class, 'store'])->name('product.store');
    Route::post('/admin/product/get-gallery', [App\Http\Controllers\Admin\Product\ProductController::class, 'AjaxGetGallery'])->name('api.get-gallery');
    Route::post('/admin/product/delete-gallery', [App\Http\Controllers\Admin\Product\ProductController::class, 'AjaxDeleteGallery'])->name('api.delete-gallery');
    Route::post('/admin/product/update', [App\Http\Controllers\Admin\Product\ProductController::class, 'update'])->name('product.update');
    Route::post('/admin/product/delete', [App\Http\Controllers\Admin\Product\ProductController::class, 'AjaxDeleteProduct'])->name('api.product-delete');

    Route::POST('/admin/user/update', [App\Http\Controllers\Admin\User\UserController::class, 'AjaxEditUser'])->name('api.user-update');
    Route::POST('/admin/user/delete', [App\Http\Controllers\Admin\User\UserController::class, 'AjaxDeleteUser'])->name('api.user-delete');
    Route::post('/contact-update', [\App\Http\Controllers\Admin\AdminController::class, 'updateStatusContact'])->name('api.contact-update');
});

Route::get('/product-models-client/{producerId}', [\App\Http\Controllers\Client\Product\ProductController::class, 'getProductModels'])->name('model-client.get-by-producer');
Route::post('/admin/check-token', [\App\Http\Controllers\Admin\AdminController::class, 'checkSessionToken'])->name('api.session-check');
Route::post('/contact-requests', [\App\Http\Controllers\Client\Product\ProductController::class, 'storeInfo'])->name('api.contact-request');
Route::post('/calculate-fee', [\App\Http\Controllers\Client\Product\ProductController::class, 'calculateFee'])->name('api.calculate-fee');
Route::post('/calculate-bank', [\App\Http\Controllers\Client\Product\ProductController::class, 'calculateBank'])->name('api.calculate-bank');

