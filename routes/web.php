<?php

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

Route::get('/', 'GuestController@faceads_home')->name('faceads');
Route::get('about', 'GuestController@about')->name('about');
Route::get('SI', 'GuestController@SI')->name('SI');//X  YOXDUR ARTIQ
Route::get('rm', 'GuestController@rm')->name('rm');//X  YOXDUR ARTIQ
Route::get('rating', 'GuestController@rating')->name('rating');//X  YOXDUR ARTIQ
Route::get('contact', 'GuestController@contact')->name('contact');
Route::get('brand1', 'GuestController@brand1');
Route::get('agentlik1', 'GuestController@agentlik1');
Route::get('freelancer1', 'GuestController@freelancer1');

Route::get('pay-start', 'GuestController@pay_and_start_ClickCounter');

//Route::get('/', function () {
//    return view('fas');
//})->name('fas');
//Route::get('about', function () {
//    return view('about');
//})->name('about');
//Route::get('SI', function () {
//    return view('SI');
//})->name('SI');
//Route::get('rm', function () {
//    return view('rm');
//})->name('rm');
//Route::get('rating', function () {
//    return view('rating');
//})->name('rating');
//Route::get('contact', function () {
//    return view('contact');
//})->name('contact');


Route::get('register', 'AuthController@registrationForm')->name('register');
Route::get('/user/verify/{token}', 'AuthController@verifyUser');
Route::get('/user/send-verify/{email}', 'AuthController@sendVerifyEmail');

Route::get('password-reset', 'PasswordController@showForm');
Route::post('password-reset', 'PasswordController@sendPasswordResetToken');
Route::get('reset-password/{token}', 'PasswordController@showPasswordResetForm');
Route::post('reset-password/{token}', 'PasswordController@resetPassword');

Route::get('freelancer', 'AuthController@registrationForm')->name('freelancer_form');
Route::get('agency', 'AuthController@registrationForm')->name('agency_form');
Route::get('brand', 'AuthController@registrationForm')->name('sahibkar_form');
Route::post('freelancer', 'AuthController@registerUser')->name('freelancer');
Route::post('agency', 'AuthController@registerUser')->name('agency');
Route::post('brand', 'AuthController@registerUser')->name('sahibkar');


//middleware('auth')->
Route::any('profile/{email}', 'ProfileController@profile')->name('profile');
Route::any('profile/{email}/edit', 'ProfileController@profile_edit')->name('profile/edit');
Route::any('user/{email}', 'ProfileController@profile_for_outsider')->name('otheruser/profile');
//Route::any('register', function () {
//    return view('auth/register');
//})->name('register');
Route::get('services', 'SMMServiceController@getService')->name('services');
Route::post('services', 'SMMServiceController@setService')->name('services');

Route::get('services/{email}', 'SMMServiceController@get_services_profile');
Route::post('searchfilter_at_entrepreneur','SMMServiceController@get_ServiceProvidersForEntrepreneur');


Route::get('{email}/mark/', 'BusinessMarkController@show_business_mark_form');
Route::post('{email}/mark/create', 'BusinessMarkController@create_business_mark');
Route::any('{email}/mark/update/{id}', 'BusinessMarkController@update_business_mark');
Route::post('{email}/mark/delete/{id}', 'BusinessMarkController@delete_business_mark');

Route::get('analyse/{id}', 'BusinessMarkController@show_business_mark_analyse')->name('business_mark_general_analyse');
Route::get('{email}/analyse/{id}', 'SMMServiceController@show_smmservice_work_analyse')->name('business_mark_with_smmservice_analyse');




//Route::any('afh', function () {
//    return view('afh');
//})->name('afh');
//Route::get('agh', function () {
//    return view('agh');
//})->name('agh');
//Route::get('MFEM', function () {
//    return view('MFEM');
//})->name('MFEM');
//Route::get('agentlik', function () {
//    return view('agentlik');
//})->name('agentlik');
Route::get('agh', 'GuestController@agh')->name('agh');
Route::get('MFEM', 'GuestController@MFEM')->name('MFEM');
Route::get('agentlik', 'GuestController@agentlik')->name('agentlik');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('login', function () {
//    return view('afh');
//})->name('login');
Route::get('login', 'AuthController@showLoginForm')->name('login');
Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout')->name('logout');

Route::get('/admin', 'AdminController@admin')->name('admin');

// Registration Routes...
//if (config('register'))
//{
//    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
//    Route::post('register', 'RegisterController@register');
//}
// Password Reset Routes...
//if (config('reset'))
//{
//    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
//    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
//    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
//}
//// Email Verification Routes...
//if (config('verify'))
//{
//    Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
//    Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
//    Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
//}
//Route::fallback(function () {
//    return redirect('/');
//});
Route::get('home', function () {
    return redirect('/');
});

Route::get('A-agentlik', function () {
    return view('profile.A-agentlik');
});
Route::get('b', function () {
    return view('profile.b');
});
Route::get('MFEM', function () {
    return view('profile.MFEM');
});
Route::get('aem', function () {
    return view('profile.aem');
});
Route::get('entrepreneur_kabinet', function () {
    return view('profile.entrepreneur_kabinet');
});
//Route::get('A-agentlik', function () {
//    return view('contact');
//});
//Route::get('A-agentlik', function () {
//    return view('contact');
//});


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('admin', 'Admin\AdminController@index');
//Route::resource('admin/roles', 'Admin\RolesController');
//Route::resource('admin/permissions', 'Admin\PermissionsController');
//Route::resource('admin/users', 'Admin\UsersController');
//Route::resource('admin/pages', 'Admin\PagesController');
//Route::resource('admin/activitylogs', 'Admin\ActivityLogsController')->only([
//    'index', 'show', 'destroy'
//]);
//Route::resource('admin/settings', 'Admin\SettingsController');
//Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
//Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

Route::group(['middleware' => ['is_admin']], function () {
    Route::get('admin', 'Admin\AdminController@index');
    Route::resource('admin/roles', 'Admin\RolesController');
    Route::resource('admin/permissions', 'Admin\PermissionsController');
    Route::resource('admin/users', 'Admin\UsersController');
    Route::resource('admin/pages', 'Admin\PagesController');
    Route::resource('admin/activitylogs', 'Admin\ActivityLogsController')->only([
        'index', 'show', 'destroy'
    ]);
    Route::resource('admin/settings', 'Admin\SettingsController');
    Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
    Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

    Route::resource('admin/custom/customanalytics', 'Admin\CustomAnalyticsController');
});
