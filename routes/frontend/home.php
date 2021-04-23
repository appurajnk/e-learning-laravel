<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\DashboardController;

/************** LANGUAGE ***********************/
Route::get('/js/lang.js', function () {
    $strings = Cache::rememberForever('lang.js', function () {
        $lang = config('app.locale');
        return get_language_strings($lang);
    });
    header('Content-Type: text/javascript');
    echo('window.i18n = ' . json_encode($strings) . ';');
    exit();
})->name('assets.lang');

/************** END LANG *********************/

/************** INSTALLER ******************/
Route::group(['namespace' => 'Installer', 'as' => 'installer.'], function(){
    Route::get('/install', 'InstallController@index')->name('index');
    Route::get('/install/requirements', 'InstallController@requirements')->name('requirements');
    Route::get('/install/database', 'InstallController@database')->name('database');
    Route::get('/install/settings', 'InstallController@settings')->name('settings');
    Route::get('/install/mail-settings', 'InstallController@mail')->name('mail');
    Route::get('/install/finish', 'InstallController@finish')->name('finish');
});

Route::get('/404/not-found', function(){
    return view('errors.404');
})->name('404');



// SITE PAGES
Route::get('page/{slug}', 'PageController@show')->name('page');

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('courses/{category}/{subcategory?}', 'CategoryController@index')->name('category');
Route::get('course/{slug}', 'CourseController@show')->name('course.show');
Route::get('user/{username}', 'UserController@show')->name('user.show');

// PAYPAL
Route::get('payment/paypal/ec-checkout', 'Payment\PayPalCheckoutController@charge')->name('paypal.checkout');
Route::get('payment/paypal/ec-success', 'Payment\PayPalCheckoutController@paymentStatus')->name('paypal.success');

// SEARCH
Route::get('search', 'CourseController@search');

/*
* These frontend controllers require the user to be logged in
* All route names are prefixed with 'frontend.'
* These routes can not be hit if the password is expired
*/
Route::group(['middleware' => ['auth', 'password_expires']], function () {

    // Course Dashboard
    Route::get('course/{slug}/learn/v1/overview', 'CourseController@DashboardOverview')->name('course.dashboard.overview');
    Route::get('course/{slug}/learn/v1/content', 'CourseController@DashboardContent')->name('course.dashboard.content');
    Route::get('course/{slug}/learn/v1/questions', 'CourseController@DashboardQuestions')->name('course.dashboard.questions');
    Route::get('course/{slug}/learn/v1/lecture/{uuid}', 'CourseController@Play')->name('course.play');
    Route::get('course/{slug}/learn/v1/questions/{uuid}', 'CourseController@DashboardShowQuestion')->name('course.dashboard.questions.show');
    Route::get('course/{slug}/learn/v1/announcements', 'CourseController@DashboardAnnouncements')->name('course.dashboard.announcements');

    // Cart
    Route::get('cart', 'CartController@cart')->name('cart');
    Route::get('cart/checkout', 'CartController@cartCheckout')->name('cart.checkout');
    Route::get('cart/checkout/express/course/{course}', 'PurchaseController@buyNow')->name('course.buynow');

    // Author
    Route::group(['namespace' => 'Author', 'as' => 'author.'], function(){
        Route::get('home/course/create', 'CourseController@create')->name('course.create');

        Route::group(['middleware' => 'is_course_author'], function(){
            Route::get('course/{uuid}/manage/basics', 'CourseController@basics')->name('course.basics');
            Route::get('course/{uuid}/manage/goals', 'CourseController@goals')->name('course.goals');
            Route::get('course/{uuid}/manage/curriculum', 'CourseController@curriculum')->name('course.curriculum');
            Route::get('course/{uuid}/manage/price-and-promotions', 'CourseController@pricing')->name('course.pricing');
            Route::get('course/{uuid}/manage/approvals', 'CourseController@approvals')->name('course.approvals');
        });
        
        // Instructor Dashboard
        Route::get('home/teaching', 'DashboardController@courses')->name('dashboard.courses');
        Route::get('home/teaching/qa', 'DashboardController@qna')->name('dashboard.qna');
        Route::get('home/teaching/reviews', 'DashboardController@reviews')->name('dashboard.reviews');
        Route::get('home/teaching/announcements', 'DashboardController@announcements')->name('dashboard.announcements');
        Route::get('home/instructor/overview', 'DashboardController@overview')->name('dashboard.overview');
        Route::get('home/instructor/revenue', 'DashboardController@revenue')->name('dashboard.revenue');
        Route::get('home/instructor/statements/{statement}', 'DashboardController@statement')->name('dashboard.revenue.statement');
    });

    
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('account', [AccountController::class, 'index'])->name('account');
        Route::get('profile/basic-information', [AccountController::class, 'basicInformation'])->name('account.basic');
        Route::get('profile/change-password', [AccountController::class, 'changePassword'])->name('account.password');
        Route::get('profile/privacy-settings', [AccountController::class, 'privacySettings'])->name('account.privacy');
        Route::get('profile/payout-settings', [AccountController::class, 'payoutSettings'])->name('account.payout');

        // User Profile Specific
        Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');

        // courses
        Route::get('home/my-courses/learning', [DashboardController::class, 'courses'])->name('dashboard.courses');
        Route::get('home/my-courses/wishlist', [DashboardController::class, 'wishlist'])->name('dashboard.wishlist');
        Route::get('home/my-courses/purchases', [DashboardController::class, 'purchases'])->name('dashboard.purchases');
        Route::get('home/purchases/{payment_id}/receipt', [DashboardController::class, 'receipt'])->name('dashboard.receipt');

        // Messages
        Route::get('home/messages', 'MessageController@index')->name('messages');

    });


});