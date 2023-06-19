<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SoundController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaptchaServiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AppController::class, 'mainPage'])->name('app.main');
Route::get('catalog/categories/{category}/', [AppController::class, 'getSoundByCategories'])->middleware(["auth", 'isBan'])->name('app.catalog-by-categories');
//Капча
Route::get('/contact-form', [CaptchaServiceController::class, 'index']);
Route::post('/captcha-validation', [CaptchaServiceController::class, 'capthcaFormValidate']);
Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);
//Категории
Route::resource('Category', CategoryController::class)->middleware('role:admin');
Route::delete('{categoryId}/removeimage', [CategoryController::class, 'removeImage'])->middleware('role:admin')->name("category.removeImage");

//Звуки
Route::prefix('sounds')->middleware(["auth", 'isBan'])->group(function () {
    Route::get('/', [SoundController::class, 'index'])->middleware('role:admin')->name("sound.index");
    Route::get('create', [SoundController::class, 'createSound'])->name("sound.create");
    Route::post('create', [SoundController::class, 'store'])->name("sound.store");
    Route::get('{soundId}/edit', [SoundController::class, 'edit'])->middleware('role:admin')->name("sound.edit");
    Route::post('{soundId}/edit', [SoundController::class, 'update'])->middleware('role:admin')->name("sound.update");
    Route::delete('{soundId}/destroySound', [SoundController::class, 'destroy'])->middleware('role:admin')->name("sound.destroy");
    Route::get('{soundId}/removeSound', [SoundController::class, 'removeSound'])->middleware('role:admin')->name("sound.remove-sound");
});
//Жалобы
Route::prefix('review')->middleware(["auth", 'isBan'])->group(function () {
    Route::get('/', [ReviewController::class, 'index'])->middleware('role:admin')->name("review.index");
    Route::get('{soundId}/create', [ReviewController::class, 'createReview'])->name("review.create");
    Route::post('create', [ReviewController::class, 'store'])->name("review.store");
    Route::delete('{reviewId}/removeReview', [ReviewController::class, 'removeReview'])->middleware('role:admin')->name("review.delete");
});
//Пользователи
Route::prefix('users')->middleware('role:admin')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name("users.index");
    Route::get("{user}/edit", [UserController::class, "edit"])->name("users.edit");
    Route::put("{user}/edit", [UserController::class, "update"])->name("users.update");
    Route::put("{user}/ban", [UserController::class, "banUser"])->name("users.ban");
    Route::delete("{userId}/delete", [UserController::class, "destroy"])->name("users.delete");
});
//Роли
Route::prefix('roles')->middleware('role:admin')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name("roles.index");
    Route::get('create', [RoleController::class, 'create'])->name("roles.create");
    Route::post('create', [RoleController::class, 'store'])->name("roles.store");
    Route::get("{role}/edit", [RoleController::class, "edit"])->name("roles.edit");
    Route::put("{role}/edit", [RoleController::class, "update"])->name("roles.update");
    Route::delete("{roleId}/delete", [RoleController::class, "destroy"])->name("roles.delete");
});

//Права
Route::prefix("permissions")->middleware('role:admin')->group(function () {
    Route::get("/", [PermissionController::class, "index"])->name("permissions.index");
    Route::get("create", [PermissionController::class, "create"])->name("permissions.create");
    Route::post("create", [PermissionController::class, "store"])->name("permissions.store");
});

//Регистрицаия
Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'registerPage'])->name("auth.register");
    Route::post('register', [AuthController::class, 'storeUser'])->name("auth.store");
    Route::get('login', [AuthController::class, 'loginPage'])->name("auth.loginPage");
    Route::post('login', [AuthController::class, 'login'])->name("auth.login");
});

Route::post('logout', [AuthController::class, 'logout'])->name("auth.logout");
