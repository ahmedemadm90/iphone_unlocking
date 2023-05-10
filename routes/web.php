<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\UnlockRequestController;
use App\Http\Controllers\UnlocRequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/dologin', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        return redirect(route('dashboard'));
    } else {
        return redirect(route('login'))->with(['error' => 'Invaled Credentials']);
    }
})->name('dologin');


Route::group(['middleware' => 'guest'], function () {
    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/dologin',[AuthController::class,'dologin'])->name('dologin');
    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::post('/doregister',[AuthController::class, 'doregister'])->name('doregister');
});


Route::get('/migrate', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    Artisan::call('migrate:fresh --seed');
    return 'app cleared';
});




Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', function () {
        auth()->logout();
        return redirect(route('login'));
    })->name('logout');

    Route::get('/', function () {
        return view('dashboard');
    })->name('home');
    Route::prefix('users')->group(function () {
        Route::get('/index', [UserController::class, 'index'])->name('users.index')->middleware(['admin']);
        Route::get('/create', [UserController::class, 'approve'])->name('users.approve')->middleware(['admin']);
        Route::get('/edit/{id}', [UserController::class, 'decline'])->name('users.decline')->middleware(['admin']);
        Route::get('/update/{id}', [UserController::class, 'decline'])->name('users.decline')->middleware(['admin']);
        Route::get('/show/{id}', [UserController::class, 'decline'])->name('users.decline')->middleware(['admin']);
    });
    Route::prefix('devices')->group(function () {
        Route::get('/index', [DeviceController::class, 'index'])->name('devices.index')->middleware(['admin']);
        Route::get('/create', [DeviceController::class, 'create'])->name('devices.create')->middleware(['admin']);
        Route::post('/store', [DeviceController::class, 'store'])->name('devices.store')->middleware(['admin']);
        Route::get('/edit/{id}', [DeviceController::class, 'edit'])->name('devices.edit')->middleware(['admin']);
        Route::post('/update/{id}', [DeviceController::class, 'update'])->name('devices.update')->middleware(['admin']);
        Route::get('/show/{id}', [DeviceController::class, 'show'])->name('devices.show')->middleware(['admin']);
    });
    Route::prefix('requests')->group(function () {
        Route::get('/index', [RequestController::class, 'index'])->name('requests.index')->middleware(['admin']);
        Route::get('/create', [RequestController::class, 'create'])->name('requests.create')->middleware(['admin']);
        Route::post('/store', [RequestController::class, 'store'])->name('requests.store')->middleware(['admin']);
        Route::get('/approve/{id}', [RequestController::class, 'approve'])->name('requests.approve')->middleware(['admin']);
        Route::get('/decline/{id}', [RequestController::class, 'decline'])->name('requests.decline')->middleware(['admin']);
    });
    Route::prefix('unlock/requests')->group(function () {
        Route::get('/index', [UnlockRequestController::class, 'index'])->name('unlock.requests.index')->middleware(['admin']);
        Route::get('/create', [UnlockRequestController::class, 'create'])->name('unlock.requests.create')->middleware(['admin']);
        Route::post('/store', [UnlockRequestController::class, 'store'])->name('unlock.requests.store')->middleware(['admin']);
        Route::get('/approve/{id}', [UnlockRequestController::class, 'approve'])->name('unlock.requests.approve')->middleware(['admin']);
        Route::get('/decline/{id}', [UnlockRequestController::class, 'decline'])->name('unlock.requests.decline')->middleware(['admin']);
    });
});
Route::group(['middleware' => 'auth','user'], function () {
    Route::get('/logout', function () {
        auth()->logout();
        return redirect(route('login'));
    })->name('logout');

    Route::get('/', function () {
        return view('dashboard');
    })->name('home');
    Route::prefix('user/requests')->group(function () {
        Route::get('/index', [RequestController::class, 'index'])->name('user.requests.index');
        Route::get('/create', [RequestController::class, 'create'])->name('requests.create');
        Route::post('/store', [RequestController::class, 'store'])->name('requests.store');
    });
    Route::prefix('user/unlock/requests')->group(function () {
        Route::get('/index', [UnlockRequestController::class, 'index'])->name('user.unlock.requests.index');
        Route::get('/create', [UnlockRequestController::class, 'create'])->name('unlock.requests.create');
        Route::post('/store', [UnlockRequestController::class, 'store'])->name('unlock.requests.store');
    });
});
