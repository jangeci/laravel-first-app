<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeAboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MultiImageController;
use App\Http\Controllers\PortfolioScreenController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAge;


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/about', function () {
    return view('about');
});
//}) ->middleware(CheckAge::class);

//Route::get('/contact', [ContactController::class, 'index'])->name('routeNameTest');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
//        $users = User::all();
        $users = DB::table('users')->get();
        return view('dashboard', compact('users'));
    })->name('dashboard');
});

Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('category.all');
//->middleware('auth')
Route::post('/category/add', [CategoryController::class, 'Add'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/category/softdelete/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/category/pdelete/{id}', [CategoryController::class, 'PDelete']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

/**
 * <<<<<<FRONTEND>>>>>>
 */
Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $homeAbout = DB::table('home_abouts')->first();
    return view('home', compact('brands', 'homeAbout'));
});

Route::get('/contact', [ContactController::class, 'Index'])->name('contact');

//PORTFOLIO PAGE
Route::get('/portfolio', [PortfolioScreenController::class, 'index'])->name('portfolio');

/**
 * <<<<<<ADMIN>>>>>>
 */
Route::get('/user/logout', [UserController::class, 'Logout'])->name('user.logout');

//Brand
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('brand.all');
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);

//IMAGES PORTFOLIO
Route::get('/multi/image', [MultiImageController::class, 'Multipic'])->name('multi.image');
Route::post('/multi/add', [MultiImageController::class, 'StoreImg'])->name('store.image');

//SLIDER
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/home/slider/add', [HomeController::class, 'AddSlide'])->name('home.slider.create');
Route::post('/home/slider/store', [HomeController::class, 'StoreSlide'])->name('home.slider.store');
Route::get('/home/slider/edit/{id}', [HomeController::class, 'EditSlide'])->name('home.slider.edit');
Route::post('/home/slider/update/{id}', [HomeController::class, 'UpdateSlide'])->name('home.slider.update');
Route::get('/home/slider/delete/{id}', [HomeController::class, 'DeleteSLide'])->name('home.slider.delete');
//ABOUT
Route::get('/home/about', [HomeAboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/home/about/add', [HomeAboutController::class, 'AddAbout'])->name('home.about.add');
Route::post('/home/about/store', [HomeAboutController::class, 'StoreAbout'])->name('home.about.store');
Route::get('/home/about/edit/{id}', [HomeAboutController::class, 'EditAbout'])->name('home.about.edit');
Route::post('/home/about/update/{id}', [HomeAboutController::class, 'UpdateAbout'])->name('home.about.update');
Route::get('/home/about/delete/{id}', [HomeAboutController::class, 'DeleteAbout'])->name('home.about.delete');

//CONTACT
Route::get('/admin/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('/admin/contact/add', [ContactController::class, 'AddContact'])->name('admin.contact.add');
Route::post('/admin/contact/store', [ContactController::class, 'StoreContact'])->name('admin.contact.store');
Route::get('/admin/contact/edit/{id}', [ContactController::class, 'EditContact'])->name('admin.contact.update');
Route::post('/admin/contact/update/{id}', [ContactController::class, 'UpdateContact'])->name('admin.contact.update');
Route::get('/admin/contact/delete/{id}', [ContactController::class, 'DeleteContact'])->name('admin.contact.delete');
Route::post('/admin/contact/form', [ContactController::class, 'ContactFormMessage'])->name('admin.contact.form');
Route::get('/admin/contact/messages', [ContactController::class, 'Messages'])->name('admin.contact.messages');
Route::get('/admin/contact/message/delete{id}', [ContactController::class, 'DeleteMessage'])->name('admin.contact.message.delete');

//CHANGE PASSWORD AND USER PROFILE
Route::get('/admin/user/change_password', [ChangePasswordController::class, 'ChangePassword'])->name('admin.change.password');
Route::post('/admin/user/change_password/update', [ChangePasswordController::class, 'PasswordUpdate'])->name('admin.password.update');

Route::get('/admin/user/profile/edit', [ChangePasswordController::class, 'ProfileEdit'])->name('admin.user.profile.edit');
Route::post('/admin/user/profile/update{id}', [ChangePasswordController::class, 'ProfileUpdate'])->name('admin.user.profile.update');

