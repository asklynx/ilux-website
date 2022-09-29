<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Price;
use App\Http\Controllers\OrderController;

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


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/what-we-do', function () {
    return view('what-we-do');
});

Route::get('/about-us', function () {
    return view('about-us');
});

Route::get('/login', function () {
    if (auth('sanctum')->user()) {
        return Redirect::route('home');
    }

    return view('log-in');
})->name('login');

Route::get('/register', function () {
    if (auth('sanctum')->user()) {
        return Redirect::route('home');
    }

    return view('regform');
});

Route::get('/offer', function () {
    return view('offer');
});

Route::get('/change-pass', function () {
    return view('change-pass');
});


//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {


    Route::get('/dashboard', function () {
        return view('home');
    });

    Route::get('/service-list', function () {
        return view('service-list');
    });

    Route::get('/order', function () {
        return view('order-view/order-form');
    });

    Route::get('/order-fb-event-1k', function () {
        return view('order-view/order-fb-event-1k');
    });

    Route::get('/order-fb-LikesAndFollow-1k', function () {
        return view('order-view/order-fb-LikesandFollow-1k');
    });

    Route::get('/order-fb-LikesAndFollow-10k', function () {
        return view('order-view/order-fb-LikesandFollow-10k');
    });

    Route::get('/order-fb-LikesAndFollow-100k', function () {
        return view('order-view/order-fb-LikesandFollow-100k');
    });

    Route::get('/order-fb-live-1k', function () {
        return view('order-view/order-fb-live-1k');
    });

    Route::get('/order-fb-members-1k', function () {
        return view('order-view/order-fb-members-1k');
    });

    Route::get('/order-fb-reacts-1k', function () {
        return view('order-view/order-fb-reacts-1k');
    });

    Route::get('/order-fb-views-1k', function () {
        return view('order-view/order-fb-views-1k');
    });

    Route::get('/order-ig-follow-1k', function () {
        return view('order-view/order-ig-follow-1k');
    });

    Route::get('/order-ig-follow-10k', function () {
        return view('order-view/order-ig-follow-10k');
    });

    Route::get('/order-ig-follow-100k', function () {
        return view('order-view/order-ig-follow-100k');
    });

    Route::get('/order-ig-likes-1k', function () {
        return view('order-view/order-ig-likes-1k');
    });

    Route::get('/order-ig-likes-10k', function () {
        return view('order-view/order-tiktok-likes-10k');
    });

    Route::get('/order-tiktok-follow-1k', function () {
        return view('order-view/order-tiktok-follow-1k');
    });

    Route::get('/order-tiktok-follow-10k', function () {
        return view('order-view/order-tiktok-follow-10k');
    });

    Route::get('/order-tiktok-follow-100k', function () {
        return view('order-view/order-tiktok-follow-100k');
    });

    Route::get('/order-tiktok-likes-1k', function () {
        return view('order-view/order-tiktok-likes-1k');
    });

    Route::get('/order-tiktok-views-1k', function () {
        return view('order-view/order-tiktok-views-1k');
    });

    Route::get('/order-tiktokph-views-1k', function () {
        return view('order-view/order-tiktokph-views-1k');
    });

    Route::get('/order-tiktokph-ads-1k', function () {
        return view('order-view/order-tiktokph-ads-1k');
    });

    Route::get('/order-twitter-likes-1k', function () {
        return view('order-view/order-twitter-likes-1k');
    });

    Route::get('/order-twitter-follow-1k', function () {
        return view('order-view/order-twitter-follow-1k');
    });

    Route::get('/order-twitter-retweet-1k', function () {
        return view('order-view/order-twitter-retweet-1k');
    });

    Route::get('/order-yt-likes-1k', function () {
        return view('order-view/order-yt-likes-1k');
    });

    Route::get('/order-yt-subs-1k', function () {
        return view('order-view/order-yt-subs-1k');
    });

    Route::get('/order-yt-views-1k', function () {
        return view('order-view/order-yt-views-1k');
    });

    Route::get('/order-ig', function () {
        return view('order-view/order-ig');
    });

    Route::get('/order-facebook', function () {
        return view('order-view/order-facebook');
    });

    Route::get('/order-twitter', function () {
        return view('order-view/order-twitter');
    });

    Route::get('/order-youtube', function () {
        return view('order-view/order-youtube');
    });

    Route::get('/order-tiktok', function () {
        return view('order-view/order-tiktok');
    });

    Route::get('/add-fund', function () {
        return view('add-fund');
    });

    Route::get('/offer-facebook', function () {
        return view('offer-facebook');
    });

    Route::get('/offer-instagram', function () {
        return view('offer-instagram');
    });

    Route::get('/offer-tiktok', function () {
        return view('offer-tiktok');
    });

    Route::get('/offer-youtube', function () {
        return view('offer-youtube');
    });

    Route::get('/offer-twitter', function () {
        return view('offer-twitter');
    });











});

//admin routes
Route::group([
    'middleware' => ['is_admin', 'auth:sanctum'],
    'prefix' => 'admin'
], function () {

    Route::get('luxxy', function () {
        return view('admin-luxy');
    });

    Route::get('/', function () {
        return view('admin-page/admin');
    });

    Route::get('orders', function () {
        return view('admin-page/admin-order');
    });

    Route::get('wallets', function () {
        return view('admin-page/admin-wallet');
    });

    Route::get('luxy', function () {
        return view('admin-page/admin-luxy');
    });

    Route::get('services', function () {
        return view('admin-page/admin-services');
    });

    Route::get('users', function () {
        return view('admin-page/admin-users');
    });
});
