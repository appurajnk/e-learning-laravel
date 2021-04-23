<?php

use App\Http\Controllers\Backend\DashboardController;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('categories', 'AdminCategoryController@index')->name('categories');
//Route::get('periods', 'PeriodsController@generatePaymentPeriods')->name('periods');
Route::get('coupons', 'AdminCouponController@index')->name('coupons');
Route::get('courses', 'AdminCourseController@index')->name('courses.all');
Route::get('courses/{uuid}', 'AdminCourseController@details')->name('courses.details');
Route::get('courses/featured', 'AdminCourseController@featured')->name('courses.featured');


Route::get('transactions', 'AdminTransactionController@index')->name('finances.transactions');
Route::get('payouts/periods', 'AdminPayoutController@index')->name('finances.payout.periods');
Route::get('payouts/period/{uuid}', 'AdminPayoutController@payoutDetails')->name('finances.payout.periods.details');
Route::get('refunds', 'AdminRefundController@index')->name('finances.refunds');


// Settings
Route::get('settings', 'AdminSettingsController@index')->name('settings');

// site pages
Route::get('pages', 'AdminPagesController@index')->name('pages');
Route::get('page/new', 'AdminPagesController@create')->name('pages.create');
Route::get('pages/{uuid}', 'AdminPagesController@edit')->name('pages.edit');

/**********************************************/
/* TRANSLATIONS */
Route::get('translations', 'AdminTranslationController@index')->name('translations.index');
Route::get('translations/{language}/edit', 'AdminTranslationController@edit')->name('translations.edit');
