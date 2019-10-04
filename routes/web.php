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
Route::any('contact', 'GuestController@contact')->name('contact');
Route::get('brand1', 'GuestController@brand1');
Route::get('agentlik1', 'GuestController@agentlik1');
Route::get('freelancer1', 'GuestController@freelancer1');

Route::get('pay-start', 'GuestController@pay_and_start_ClickCounter');



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



Route::any('profile/{email}', 'ProfileController@profile')->name('profile');
Route::any('profile/{email}/edit', 'ProfileController@profile_edit')->name('profile/edit');
Route::any('user/{email}', 'ProfileController@profile_for_outsider')->name('otheruser/profile');


Route::get('services', 'SMMServiceController@getService')->name('services');
Route::post('services', 'SMMServiceController@setService')->name('services');

Route::get('services/{email}', 'SMMServiceController@get_services_profile');
Route::post('searchfilter_at_entrepreneur','SMMServiceController@get_ServiceProvidersForEntrepreneur');
Route::post('works_of_serviceprovider','SMMServiceController@get_WorksOfServiceProvider');
Route::get('{email}/add-smm-work', 'SMMServiceController@show_smm_work_form');
Route::post('{email}/add-smm-work', 'SMMServiceController@create_smm_service');
Route::any('{email}/smmservice/update/{id}', 'SMMServiceController@update_smm_service');
Route::post('{email}/smmservice/delete/{id}', 'SMMServiceController@delete_smm_service');


Route::get('{email}/mark/', 'BusinessMarkController@show_business_mark_form');
Route::post('{email}/mark/create', 'BusinessMarkController@create_business_mark');
Route::any('{email}/mark/update/{id}', 'BusinessMarkController@update_business_mark');
Route::post('{email}/mark/delete/{id}', 'BusinessMarkController@delete_business_mark');

Route::get('analyse/{id}', 'BusinessMarkController@show_business_mark_analyse')->name('business_mark_general_analyse');
Route::get('{email}/analyse/{id}', 'SMMServiceController@show_smmservice_work_analyse')->name('business_mark_with_smmservice_analyse');





Route::get('agh', 'GuestController@agh')->name('agh');
Route::get('MFEM', 'GuestController@MFEM')->name('MFEM');
Route::get('agentlik', 'GuestController@agentlik')->name('agentlik');


Route::get('login', 'AuthController@showLoginForm')->name('login');
Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout')->name('logout');

Route::get('/admin', 'AdminController@admin')->name('admin');

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

Route::get('badbrowser', function () {
    return view('badbrowser');
});
