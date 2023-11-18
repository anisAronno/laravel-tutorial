<?php

use App\Events\UserRegistrationEvent;
use App\Http\Controllers\AboutController as FrontendAboutController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BlogController as FrontendBlogController;
use App\Http\Controllers\ContactController as FrontendContactController;
use App\Http\Controllers\HomeController;
use App\Jobs\TestJob;
use App\Mail\TestMail;
use App\Models\User;
use App\Notifications\UserRegistrationNotification;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

Route::prefix('admin')->controller(UserController::class)->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    //user route
    Route::get('/user', 'index')->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', 'store')->name('user.store');
    Route::get('/user/{user}', 'show')->where('id', '[0-9]+')->name('user.show');
    Route::delete('/user/delete/{user}', [UserController::class, 'destroy'])->name('user.delete');

    Route::post('/user/image/{user}', [UserController::class, 'avatarChange'])->name('user.avatar.change');

    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');

    Route::put('/user/update/{user}', [UserController::class, 'update'])->name('user.update');

    // Blog Route
    Route::resource('/blog', BlogController::class);


    Route::get('/about', [AboutController::class, 'index'])->name('about.index');


    Route::resource('contact', ContactController::class);

    Route::get('/report', [ReportController::class, 'index'])->name('report.index');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('me', [AuthController::class, 'me'])->name('me');
    Route::get('/password/reset', [AuthController::class, 'passwordReset'])->name('password.reset');
    Route::post('/password/reset', [AuthController::class, 'passwordResetProcess'])->name('password.reset.process');
});

//Auth Route
Route::get('login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('password-recover', [AuthController::class, 'passwordRecover'])->name('password.recover')->middleware('guest');
Route::post('password-recover', [AuthController::class, 'passwordRecoverProcess'])->name('password.recover.store')->middleware('guest');
Route::post('login', [AuthController::class, 'loginProcess'])->name('loginProcess');

Route::get('/reset-password/{token}', [AuthController::class,'resetPassword'])->middleware('guest')->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'passwordUpdate'])->middleware('guest')->name('password.update');


//frontend route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [FrontendAboutController::class, 'index'])->name('about');
Route::get('/blog', [FrontendBlogController::class, 'index'])->name('blog');
Route::get('/blog/{blog:slug}', [FrontendBlogController::class, 'show'])->name('blog.show');
Route::get('/contact', [FrontendContactController::class, 'index'])->name('contact');
Route::post('/contact', [FrontendContactController::class, 'store'])->name('contact.store');


Route::get('mail', function () {

    Mail::to(auth()->user())->send(new TestMail(auth()->user()));

    return "Mail Send";
})->middleware(['auth']);


Route::get('job', function () {
    $order = [
        'amount' => 30,
        'product' => 'I Phone 15 pro',
        'receiver' => 'Kader',
        'address' => 'Khulna',
        'email' => 'anis@gmail.com'
    ];

    TestJob::dispatch($order);

})->name('job');



Route::get('cache', function () {

    Cache::put('test', 'test data store', 10);

    echo  Cache::get('test');

    // Cache::forget('test');

    // echo "Cache Saved";
});


Route::get('http', function () {

    $http = new PendingRequest();
    $http->baseUrl('https://jsonplaceholder.typicode.com/')
        ->acceptJson()
        ->retry(3, 100)
        ->contentType('application/json');

    try {
        $response = $http->get('todos');

        if($response->successful()) {
            return $response->json();
        } else {
            echo $response->body();
        }
    } catch (HttpClientException $th) {
        echo $th->getMessage();
    }
});


Route::get('event', function () {

    $user = User::find(1);
    UserRegistrationEvent::dispatch($user);
});
