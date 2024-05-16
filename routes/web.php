<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\General\Profile\AccountController;
use App\Http\Controllers\General\Profile\AddressBookController;
use App\Http\Controllers\General\ProfileController;
use App\Http\Controllers\General\BookController;
use App\Http\Controllers\General\CartController;
use App\Http\Controllers\General\HomeController;
use App\Http\Controllers\General\StripeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();


/*
| -------------------------------------
| Admin routes
| -------------------------------------
*/
Route::middleware('isAdmin')->prefix('admin')->group(function() {
    // Permissions
    Route::resource('permissions', PermissionController::class)
        ->name('index', 'admin.permissions.index')
        ->name('create', 'admin.permissions.create')
        ->name('edit', 'admin.permissions.edit')
        ->name('update', 'admin.permissions.update')
        ->name('store', 'admin.permissions.store');
    Route::get('permissions/{id}/delete', [PermissionController::class, 'destroy'])
        ->name('admin.permissions.destroy');

    // Roles
    Route::resource('roles', RoleController::class)
    ->name('index', 'admin.roles.index')
    ->name('create', 'admin.roles.create')
    ->name('edit', 'admin.roles.edit')
    ->name('update', 'admin.roles.update')
    ->name('store', 'admin.roles.store');
    Route::get('roles/{id}/delete', [RoleController::class, 'destroy'])        ->name('admin.roles.destroy');

    //  Roles => Manage permissions
    Route::get('roles/{id}/manage-permission', [RoleController::class, 'managePermissions'])
        ->name('admin.roles.manage');
    Route::put('roles/{id}/give-permission', [RoleController::class, 'givePermissions'])
        ->name('admin.roles.permit');

    // Admin BookController
    Route::get('/books/search', [AdminBookController::class, 'search'])->name('admin.books.search');
    Route::resource('books', AdminBookController::class)
        ->name('index', 'admin.books.index')
        ->name('create', 'admin.books.create')
        ->name('edit', 'admin.books.edit')
        ->name('store', 'admin.books.store')
        ->name('update', 'admin.books.updateDetails')
        ->except(['show']);
    Route::put('/books/{book}/update-cover', [AdminBookController::class, 'updateBookCover'])->name('admin.books.updateCover');


    // Admin UserController
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::get('/users/search', [AdminUserController::class, 'search'])->name('admin.users.search');
    
    }
);



/*
| -------------------------------------
| General routes
| -------------------------------------
|
| These are routes accessible to all 
| authenticated users
|
| -------------------------------------
*/
Route::middleware('auth')->prefix('/profile')->group(function() {
    Route::get('/', [ProfileController::class, 'index'])->name('general.profile.index');

    Route::resource('account', AccountController::class)
        ->name('index', 'general.profile.account.index')
        ->name('update', 'general.profile.account.update')
        ->except(['create', 'store', 'edit', 'show', 'destroy']);
    Route::get('/account/password-reset', [AccountController::class, 'showResetForm'])->name('general.account.password.reset');
    Route::post('/account/password/reset', [AccountController::class, 'resetPassword'])->name('general.account.password.update');

    Route::resource('addresses', AddressBookController::class)
        ->name('index', 'general.profile.addresses.index')
        ->name('create', 'general.profile.addresses.create')
        ->name('update', 'general.profile.addresses.update')
        ->name('store', 'general.profile.addresses.store')
        ->name('edit', 'general.profile.addresses.edit')
        ->except(['show']);
    Route::get('/addresses/{address}/delete', [AddressBookController::class, 'destroy'])
        ->name('general.profile.addresses.destroy');

});

Route::middleware('auth')->group(function() {
    Route::get('/sell-a-book', [BookController::class, 'showSellForm'])->name('general.book.show-sell-form');
    Route::get('/new-book', [BookController::class, 'create'])->name('book.create');
    Route::post('/book', [BookController::class, 'store'])->name('book.store');
    Route::middleware('auth')->post('/list-book', [BookController::class, 'sell'])->name('general.book.sell');

    Route::get('/cart', [CartController::class, 'index'])->name('general.cart.index');
    
    Route::prefix('checkout')->group(function() {
        ROute::get('/', [StripeController::class, 'process'])->name('checkout');
        ROute::get('/overview', [StripeController::class, 'overview'])->name('checkout.overview');
        Route::get('/stripe', [StripeController::class, 'checkout'])->name('checkout.stripe');
        Route::get('/success/{transaction}', [StripeController::class, 'success'])->name('checkout.success');
        Route::get('/cancel/{transaction}', [StripeController::class, 'cancel'])->name('checkout.cancel');
        Route::get('/webhook', [StripeController::class, 'webhook'])->name('checkout.webhook');
    });
});

Route::middleware('guest')->group(function() {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
    Route::get('/start', function() {
        return view('start');
    })->name('start');
});


// HomeController
Route::get('/home', [HomeController::class, 'index'])->name('general.home');
Route::get('/search', [BookController::class, 'search'])->name('general.book.search');
Route::get('book/show/{book}', [BookController::class, 'show'])->name('general.book.show');


