<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\API\API;
use App\Http\Controllers\API\SendEmailMobile;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// $router->group([
//     'as' => 'api_',
//     'middleware' => []
// ], function () use ($router) {

//     // $router->post('/upload-image', 'ImageController@upload')->name('upload_image');
//     // Route::post('/upload-image', [App\Http\Controllers\HomeController::class, 'upload'])->name('upload_image');
//     $router->post('/upload-image', [App\Http\Controllers\ImageController::class, 'upload'])->name('upload_image');
// });

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::group([
//     'middleware' => ['auth', 'pelanggan'],
//     'prefix' => 'app',
//     'namespace' => 'API',

// ], function () {

//     Route::get('/{name}', [FrontendController::class, 'tempatshow'])->name('front.show');
// });
// Route::post('midtrans/gopay/create', 'Api\Payment\PaymentController@createGopay');
// Route::post('midtrans/pay', 'Api\Payment\PaymentController@getPayment');

//mobile
Route::get('/tempat', [API::class, 'tempat']);
Route::get('/tempat/{id}', [API::class, 'wahanabytempat']);
Route::get('/kuliner/{id}', [API::class, 'menukuliner']);
Route::get('/kuliner', [API::class, 'kuliner']);

Route::get('/desa', [API::class, 'desa']);
Route::get('/listevent', [API::class, 'listevent']);
Route::get('/hotel', [API::class, 'hotel']);
Route::get('/villa', [API::class, 'villa']);


Route::get('/wahana', [API::class, 'wahana']);
Route::post('/wahana/create', [API::class, 'createwahana']);
Route::post('/wahana/update', [API::class, 'editwahana']);
Route::post('/wahana/delete', [API::class, 'deletewahana']);

Route::get('/cart', [API::class, 'getCart']);
Route::post('/cart/tambah', [API::class, 'addCart']);

Route::post('/checkout', [API::class, 'addTransaksi']);

Route::get('/pesananku', [API::class, 'getPesanan']);
Route::get('/daftartransaksi', [API::class, 'getTransaksi']);

Route::post('/tiket', [API::class, 'getTiket']);
Route::post('/tiket/detail', [API::class, 'getTiketDetail']);


Route::get('/event', [API::class, 'event']);
Route::get('/kamar', [API::class, 'kamar']);
Route::get('/kuliner', [API::class, 'kuliner']);
Route::get('/desa', [API::class, 'desa']);
Route::get('/user', [API::class, 'user']);
Route::get('/login', [API::class, 'checkLogin']);
Route::post('/register', [API::class, 'register']);
Route::post('/login', [API::class, 'login']);
Route::get('/logout', [API::class, 'logout']);

Route::get('/pay/finish', [API::class, 'finish']);
Route::post('/pay/payment', [API::class, 'payment']);

Route::post('/sendEmail', [SendEmailMobile::class, 'sendOtp']);