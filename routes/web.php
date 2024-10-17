<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware(['check-admin-login'])->group(function () {
    Route::get('/admin/index', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/category/index', [\App\Http\Controllers\Admin\Category\CategoryController::class, 'index'])->name('category.index');
    Route::get('/admin/producer/index', [\App\Http\Controllers\Admin\Producer\ProducerController::class, 'index'])->name('producer.index');
    Route::get('/admin/attribute/index', [\App\Http\Controllers\Admin\Attribute\AttributeController::class, 'index'])->name('attribute.index');
    Route::get('/admin/attribute/spec/by-attribute/{id}', [\App\Http\Controllers\Admin\AttributeSpec\AttributeSpecController::class, 'index'])->name('spec.index');
    Route::get('/admin/producer/model/by-producer/{id}', [\App\Http\Controllers\Admin\ProductModel\ProductModelController::class, 'index'])->name('model.index');
    Route::get('/admin/status/index', [\App\Http\Controllers\Admin\Status\StatusController::class, 'index'])->name('status.index');
    Route::get('/admin/product/index', [\App\Http\Controllers\Admin\Product\ProductController::class, 'index'])->name('product.index');
    Route::get('/admin/product/form-create', [\App\Http\Controllers\Admin\Product\ProductController::class, 'create'])->name('product-form.create');
    Route::get('/admin/product/form-edit/{id}', [\App\Http\Controllers\Admin\Product\ProductController::class, 'edit'])->name('product-form.edit');
    Route::get('/admin/user/index', [\App\Http\Controllers\Admin\User\UserController::class, 'index'])->name('user.index');

    Route::get('/admin/facebook-integration-post', [\App\Http\Controllers\Social\FacebookApp\FacebookIntegrationController::class, 'index'])->name('facebook.integration-post');
    Route::post('/admin/facebook-post-publish', [\App\Http\Controllers\Social\FacebookApp\FacebookIntegrationController::class, 'postToFacebook'])->name('facebook.post-publish');
    Route::get('/admin/facebook-products/{id}', [\App\Http\Controllers\Social\FacebookApp\FacebookIntegrationController::class, 'show'])->name('facebook-show-product');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/profile-update', [\App\Http\Controllers\Client\ClientController::class, 'updateUserProfile'])->name('user-profile-update');
    Route::get('/user-profile', [\App\Http\Controllers\Client\ClientController::class, 'userProfile'])->name('user-profile');
    Route::post('/password-update', [\App\Http\Controllers\Client\ClientController::class, 'updateUserPassword'])->name('user-password-update');
    Route::get('/chat', function () {
        return view('common.chat');
    });
});

Route::middleware([\App\Http\Middleware\TrackVisitor::class])->group(function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Routes cho đăng nhập bằng Facebook
    Route::get('login/facebook', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook']);
    Route::get('login/facebook/callback', [\App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);

    Route::get('login/google', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('login/google/callback', [\App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

    Route::post('/verify-otp', [\App\Http\Controllers\Auth\RegisterController::class, 'verifyOtp'])->name('verify-otp');
    Route::get('/verify-otp', [\App\Http\Controllers\Auth\RegisterController::class, 'showOtpForm'])->name('verifyOtp');
    Route::post('/register-verify-otp', [\App\Http\Controllers\Auth\RegisterController::class, 'registerVerifyOtp'])->name('registerVerifyOtp');
    Route::get('/resend-otp', [\App\Http\Controllers\Auth\RegisterController::class, 'resendOtp'])->name('resend-otp');

    Route::get('/product-detail/{id}', [\App\Http\Controllers\Client\Product\ProductController::class, 'detail'])->name('product.detail');
    Route::get('/product-by-producer/{id}', [\App\Http\Controllers\Client\Product\ProductController::class, 'showProductByProducer'])->name('product.by-producer');
    Route::post('/search', [\App\Http\Controllers\Client\Product\ProductController::class, 'search'])->name('search');
    Route::post('/product-search', [\App\Http\Controllers\Client\Product\ProductController::class, 'productSearch'])->name('product.search');
    Route::get('/product-list', [\App\Http\Controllers\Client\Product\ProductController::class, 'productList'])->name('product.list');
    Route::get('/contact', [\App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
});