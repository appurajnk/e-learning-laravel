<?php

use Illuminate\Http\Request;
// from installer

Route::group(['namespace' => 'Api\v1', 'middleware' => ['check_demo', 'XSS']], function () {

    Route::group(['middleware' => 'web', 'namespace' => 'Installer'], function () {
        Route::post('installer/requirements', 'InstallController@checkRequirements');
        Route::post('installer/database', 'InstallController@setDatabase');
        Route::get('installer/database', 'InstallController@getDatabaseInfo');
        Route::post('installer/settings', 'InstallController@saveSettings');
        Route::post('installer/mail', 'InstallController@saveMailSettings');
        Route::post('installer/finish', 'InstallController@finish');
        Route::post('installer/license', 'InstallController@checkLicense');

        Route::post('installer/update', 'UpdateController@updateToLatest');
    });

    // Languages
    Route::get('/languages', function(){
        return response()->json(config('languages'), 200);
    }); 

    /*----------------------------------------------------------------
    | AUTHENTICATION ROUTES (NAMESPACED)
    |----------------------------------------------------------------*/
    Route::group(['middleware' => 'web', 'namespace' => 'Auth'], function () {
        // ******* Authenticated User Routes ******************
        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('logout', 'Auth\LoginController@logout');
            Route::get('user', function (Request $request) {
                return $request->user();
            });
        });
        // ******* GUEST USER ROUTES **************************
        Route::group(['middleware' => 'guest:api'], function () {
            Route::post('login', 'LoginController@login');
            Route::post('register', 'RegisterController@register');
            Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
            Route::post('password/reset', 'ResetPasswordController@reset');
            Route::post('email/verify/{user}', 'VerificationController@verify')->name('verification.verify');
            Route::post('email/resend', 'VerificationController@resend');
        });
    });

    
    /*----------------------------------------------------------------
    | GENERAL ROUTES (NAMESPACED)
    |----------------------------------------------------------------*/
    Route::group(['namespace' => 'General'], function () {
        // Homepage Data
        Route::get('home/getMostViewedCourses', 'HomeController@getMostViewedCourses');
        Route::get('home/getCategoryCourses', 'HomeController@getCategoryCourses');


        //-- Categories
        Route::get('categories/findBySlug/{slug}', 'CategoryController@findBySlug');
        Route::resource('categories', 'CategoryController');

        //-- Search
        Route::post('search', 'SearchController@filters');
        Route::get('search/filters/{category}', 'SearchController@fetchFilterParameters');

        //-- Autocomplete search
        Route::get('autocomplete/courses', 'SearchController@fetchAutocompleteCourses');
        Route::get('autocomplete/users', 'SearchController@fetchAutocompleteUsers');

        //-- Course
        Route::get('courses/find/{id}', 'CourseController@find');
        Route::get('courses/findBySlug/{slug}', 'CourseController@findBySlug');
        Route::get('courses/{id}/user-can-access', 'CourseController@checkIfUserCanAccess');
        Route::get('courses/{slug}/user-can-access-by-slug', 'CourseController@checkIfUserCanAccessBySlug');

        //-- Lesson
        Route::get('lessons/findByUuid/{uuid}', 'LessonController@findByUuid');

        //-- Content
        Route::post('contents/{id}/update-duration', 'LessonController@updateDuration');

        //-- Cart
        Route::get('cart/items', 'CartController@fetchCartItems');
        Route::post('cart', 'CartController@addToCart');
        Route::post('cart/items/remove', 'CartController@remove');
        Route::post('cart/applyCoupon', 'CartController@applyCoupon');
        Route::post('cart/removeCoupon', 'CartController@removeCoupon');
        Route::get('cart/checkout/express/course/{uuid}', 'CartController@moveToCart');
        Route::get('cart/containsItem/{course_id}', 'CartController@checkIfCourseIsInCart');

        // reviews
        Route::post('course/{id}/fetchReviews', 'ReviewController@fetchReviews');
        Route::get('course/{id}/reviews/fetchSummary', 'ReviewController@fetchSummary');

        // currencies
        Route::get('/currencies', 'CurrencyController@index');

        // User public profile
        Route::get('/user/{username}', 'UserController@index');

        // ******* AUTHENTICATED USER ROUTES **************************
        Route::post('settings/picture/upload', 'Settings\ProfileController@uploadProfileImage');
        Route::group(['middleware' => 'web'], function () {
            Route::post('logout', 'Auth\LoginController@logout');
            
            Route::get('/user', function (Request $request) {
                return new \App\Http\Resources\UserResource($request->user());
            });
            
            // User profile update
            Route::put('settings/profile', 'Settings\ProfileController@update');
            Route::put('settings/payout', 'Settings\ProfileController@updatePayoutSettings');
            Route::put('settings/password', 'Settings\PasswordController@update');
            
            
            
            // course dashboard header info
            Route::post('cart/enroll-now', 'CartController@EnrollNow');
            Route::get('course/{id}/dashboard-header-info', 'CourseController@DashboardHeaderInformation');
            Route::post('course/{id}/reset-progress', 'CourseController@ResetProgress');
            
            // Dashboard overview info
            Route::get('course/{id}/fetchOverviewInfo', 'CourseController@fetchOverviewInfo');
            
            // lesson completion
            Route::get('lesson/{id}/toggle-complete', 'LessonController@toggleComplete');
            
            // lesson play
            Route::get('/player/lesson/{uuid}', 'LessonController@play');

            // course questions
            Route::post('questions/fetchQuestions', 'QuestionController@fetchQuestions');
            Route::get('questions/{uuid}', 'QuestionController@fetchQuestion');
            Route::post('questions/store', 'QuestionController@storeQuestion');
            Route::put('questions/{id}', 'QuestionController@updateQuestion');
            Route::delete('questions/{id}', 'QuestionController@destroyQuestion');
            
            // course announcements
            Route::post('course/announcements/{course_uuid}', 'AnnouncementController@fetchAnnouncements');

            // Comments
            Route::post('comments/{modelId}/fetchComments', 'CommentController@fetchComments');
            Route::get('comment/{id}/fetchComment', 'CommentController@fetchComment');
            Route::post('comment/storeComment', 'CommentController@store');
            Route::put('comment/{id}/updateComment', 'CommentController@update');
            Route::delete('comment/{id}/destroyComment', 'CommentController@destroy');
            Route::get('comment/{id}/markAsAnswer', 'CommentController@markAsAnswer');
            
            // Reviews
            Route::post('course/storeReview', 'ReviewController@store');
            Route::put('review/{id}/updateReview', 'ReviewController@update');
            Route::delete('review/{id}/delete', 'ReviewController@destroy');
            
            
            // User Dashboard
            Route::get('user/categories/all', 'User\DashboardController@fetchUserCourseCategories');
            Route::post('user/courses/learning', 'User\DashboardController@fetchCourses');
            Route::get('user/purchases/all', 'User\DashboardController@fetchPurchaseHistory');
            Route::get('user/refunds/all', 'User\DashboardController@fetchUserRefunds');
            Route::post('user/payment/refund', 'User\DashboardController@createRefundRequest');
            Route::get('user/payments/refundable', 'User\DashboardController@fetchPaymentsThatCanBeRefunded');
            
            // Messages
            Route::get('conversations', 'MessageController@getUserConversations');
            Route::post('conversations', 'MessageController@createConversation');
            Route::get('conversations/{conversation}/messages', 'MessageController@getConversationMessages');
            Route::post('conversations/{conversation}/messages', 'MessageController@sendMessage');
            

        });

        

        
    });

    
    /*----------------------------------------------------------------
    | AUTHOR ROUTES
    |----------------------------------------------------------------*/

    Route::group(['namespace' => 'Author'], function () {
        Route::post('courses/upload-cover-image/{id}', 'AuthorCourseController@uploadCoverImage');
        Route::get('courses/{id}/attachments', 'AuthorCourseController@getAttachments');
        Route::delete('attachments/{id}', 'AuthorCourseController@deleteAttachment');
        Route::post('lessons/{id}/video/upload', 'AuthorContentController@uploadVideo');
        Route::post('lessons/{id}/attachments', 'AuthorContentController@uploadAttachments');
        
        // ******* Authenticated Author Routes ******************
        Route::group(['middleware' => 'web'], function () {
            // revenue
            Route::get('revenue', 'AuthorRevenueController@getAuthorRevenue');
            Route::get('sales-summary', 'AuthorRevenueController@getSalesChartData');
            Route::get('statements/{statement}', 'AuthorRevenueController@fetchStatementDetails');
            
            // course
            Route::put('courses/updatePrice/{id}', 'AuthorCourseController@updatePrice');
            Route::get('courses/findByUuid/{uuid}', 'AuthorCourseController@findByUuid');
            Route::resource('courses', 'AuthorCourseController');
            
            // course requirements
            Route::post('course/{id}/target', 'AuthorCourseTargetController@store');
            Route::get('course/{id}/target', 'AuthorCourseTargetController@fetchCourseRequirements');
            Route::put('course/targets/save-draggable', 'AuthorCourseTargetController@updateDraggable');
            
            // sections
            Route::put('sections/save-draggable', 'AuthorSectionController@updateDraggable');
            Route::resource('sections', 'AuthorSectionController');
            Route::get('sections/findByCourse/{id}', 'AuthorSectionController@findByCourse');
            
            // lessons
            Route::put('lessons/save-draggable', 'AuthorLessonController@updateDraggable');
            Route::get('lessons/findByCourse/{id}', 'AuthorLessonController@findByCourse');
            Route::get('lessons/findBySection/{id}', 'AuthorLessonController@findBySection');
            Route::resource('lessons', 'AuthorLessonController')->except(['index']);
            
            // Content
            Route::get('contents/findByLesson/{id}', 'AuthorContentController@findByLesson');
            Route::resource('contents', 'AuthorContentController')->only(['store']);
            
            // pricing and coupon
            Route::put('coupons/{id}/activate', 'AuthorCouponController@activate');
            Route::get('coupons/findByCourse/{id}', 'AuthorCouponController@findByCourse');
            Route::resource('coupons', 'AuthorCouponController');
            
            // Author dashboard
            Route::post('author/courses', 'AuthorDashboardController@findAuthorCourses');
            
            // Reviews
            Route::post('author/reviews', 'AuthorDashboardController@findAuthorReviews');
            
            // Submit course for review
            Route::get('author/course/{uuid}/submit', 'AuthorCourseController@submitForReview');

            // Announcements
            Route::get('author_announcements', 'AuthorAnnouncementController@fetchAuthorAnnouncements');
            Route::post('announcements', 'AuthorAnnouncementController@storeAnnouncement');
            Route::put('announcements/{id}/update', 'AuthorAnnouncementController@updateAnnouncement');
            Route::delete('announcements/{uuid}', 'AuthorAnnouncementController@destroyAnnouncement');
            
        });
        
    });


    /*----------------------------------------------------------------
    | PAYMENT ROUTES
    |----------------------------------------------------------------*/
    Route::group(['namespace' => 'Payment'], function () {
        // ******* AUTHENTICATED USER ROUTES **************************
        Route::group(['middleware' => 'web'], function () {
            Route::post('cart/payment/process', 'StripePaymentController@process');
            Route::post('cart/payment/razorpay/process', 'RazorPayController@process');
        });
    });



    /*----------------------------------------------------------------
    | ADMIN ROUTES
    |----------------------------------------------------------------*/
    Route::group(['namespace' => 'Admin', 'middleware' => 'admin', 'prefix' => 'admin'], function () {
        // Dashboard info
        Route::get('dashboard/fetch_admin_sales_data', 'AdminDashboardController@fetchAdminSalesChartData');


        /* Coupons */
        Route::get('coupons', 'AdminCouponController@index');

        /* Courses */
        Route::get('courses', 'AdminCourseController@index');
        Route::post('course/{uuid}/approve', 'AdminCourseController@approval');
        Route::get('course/{uuid}', 'AdminCourseController@fetchCourse');
        Route::get('course/{uuid}/approvals', 'AdminCourseController@fetchCourseApprovals');
        Route::get('fetchCategoriesWithCourses', 'AdminCourseController@fetchCategoriesWithCourses');
        
        // Finances
        Route::get('transactions', 'AdminTransactonsController@index');
        Route::get('periods', 'AdminPayoutController@fetchPeriods');
        Route::get('periods/{uuid}', 'AdminPayoutController@fetchPeriod');
        Route::get('periods/{uuid}/payouts', 'AdminPayoutController@fetchPayoutsForPeriod');
        Route::post('periods/{uuid}/close', 'AdminPayoutController@closePeriod');
        Route::get('refunds', 'AdminRefundController@index');
        Route::post('refunds/{uuid}/process', 'AdminRefundController@process');
        Route::post('payouts/{uuid}/process', 'AdminPayoutController@processPayout');
        Route::post('send_reminder_for_paypal_email', 'AdminPayoutController@sendEmailReminder');
        Route::post('payouts/{uuid}/fetchStatusUpdate', 'AdminPayoutController@fetchPayoutStatusUpdate');

        // Categories
        Route::get('categories', 'AdminCategoryController@index');
        Route::post('categories', 'AdminCategoryController@store');
        Route::get('category/{id}', 'AdminCategoryController@findById');
        Route::put('category/{id}', 'AdminCategoryController@update');
        Route::delete('category/{id}', 'AdminCategoryController@destroy');
        Route::put('update_categories_order', 'AdminCategoryController@orderCategories');

        // Users
        Route::get('users', 'AdminUserController@index');
        Route::get('user/{id}/toggleActive', 'AdminUserController@toggleActive');
        Route::get('users/{uuid}', 'AdminUserController@fetchUser');
        Route::get('user/{uuid}/getUnenrolled', 'AdminUserController@getUnenrolledCourses');
        Route::post('user/enroll', 'AdminUserController@enroll');
        Route::get('user/unenroll', 'AdminUserController@unenroll');

        // Currencies
        Route::get('currencies', 'AdminCurrencyController@index');
        Route::post('currencies', 'AdminCurrencyController@store');
        Route::put('currencies/{id}', 'AdminCurrencyController@update');
        Route::delete('currencies/{id}', 'AdminCurrencyController@destroy');
        Route::put('currency/{id}/mark_as_primary', 'AdminCurrencyController@markAsPrimary');
        Route::put('currency/{id}/toggle_enabled', 'AdminCurrencyController@toggleEnabled');


        // Settings
        Route::post('settings/payment', 'AdminSettingsController@save_payment_settings');
        Route::post('settings/site', 'AdminSettingsController@save_site_settings');
        Route::post('settings/mail', 'AdminSettingsController@save_mail_settings');
        Route::get('settings', 'AdminSettingsController@fetchSettings');

        // Theme colors
        Route::get('settings/theme', 'AdminSettingsController@getStyles');
        Route::post('settings/theme', 'AdminSettingsController@saveStyles');

        // Logos
        Route::post('settings/upload', 'AdminSettingsController@uploadLogo');


        // Translations / languages
        Route::get('languages', 'AdminTranslationController@fetchAllLanguages');
        Route::post('languages', 'AdminTranslationController@store');
        Route::delete('languages/{id}', 'AdminTranslationController@destroy');
        Route::put('languages/{id}', 'AdminTranslationController@updateLanguage');
        

        // Site pages
        Route::get('pages', 'AdminPagesController@fetchAll');
        Route::get('page/{uuid}', 'AdminPagesController@getByUuid');
        Route::get('page/{uuid}/locale/{locale}', 'AdminPagesController@fetchPageForLocale');
        Route::post('pages', 'AdminPagesController@store');
        Route::put('page/{uuid}', 'AdminPagesController@update');
        Route::put('page/{id}/update_slug', 'AdminPagesController@updateSlug');
        Route::put('page/{id}/toggle_publish', 'AdminPagesController@togglePublish');
        Route::delete('pages/{id}', 'AdminPagesController@destroy');

        // Empty database
        Route::post('empty_database', 'AdminDashboardController@emptyDatabase');

    });

});