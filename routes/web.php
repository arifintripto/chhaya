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

use App\Models\settings;

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
}

//Default Controller
Route::get('/', 'HomeController@index');
Route::post('/home/submit', 'HomeController@submit');
Route::get('/home/skin/{any?}', 'HomeController@getSkin');


Route::get('dashboard/import', 'DashboardController@getImport');
/* Auth & Profile */
Route::get('user/profile','UserController@getProfile');
Route::get('user/theme','UserController@getTheme');
Route::get('user/login','UserController@getLogin')->name('login');
Route::get('user/register','UserController@getRegister');
Route::get('user/logout','UserController@getLogout');
Route::get('user/reminder','UserController@getReminder');
Route::get('user/reset/{any?}','UserController@getReset');
Route::get('user/reminder','UserController@getReminder');
Route::get('user/activation','UserController@getActivation');

// Social Login
Route::get('user/socialize/{any?}','UserController@socialize');
Route::get('user/autosocialize/{any?}','UserController@autosocialize');
//
Route::post('user/signin','UserController@postSignin');
Route::post('user/login','UserController@postSigninMobile');
Route::post('user/signup','UserController@postSignupMobile');
Route::post('user/create','UserController@postCreate');
Route::post('user/saveprofile','UserController@postSaveprofile');
Route::post('user/savepassword','UserController@postSavepassword');
Route::post('user/doreset/{any?}','UserController@postDoreset');
Route::post('user/request','UserController@postRequest');

/* Posts & Blogs */
Route::get('posts','HomeController@posts');
Route::get('posts/category/{any}','HomeController@posts');
Route::get('posts/read/{any}','HomeController@read');
Route::post('posts/comment','HomeController@comment');
Route::get('posts/remove/{id?}/{id2?}/{id3?}','HomeController@remove');
// Start Routes for Notification
Route::resource('notification','NotificationController');
Route::get('home/load','HomeController@getLoad');
Route::get('home/lang/{any}','HomeController@getLang');
Route::get('/set_theme/{any}', 'HomeController@set_theme');

include('pages.php');


Route::resource('concaveapi','ConcaveapiController');
Route::resource('services/posts', 'Services\PostController');


// Routes for  all generated Module
include('module.php');
// Custom routes
$path = base_path().'/routes/custom/';
$lang = scandir($path);
foreach($lang as $value) {
	if($value === '.' || $value === '..') {continue;}
	include( 'custom/'. $value );

}
// End custom routes
Route::group(['middleware' => ['auth', 'preventBackHistory']], function() {
  Route::resource('dashboard','DashboardController');
});


Route::group(['namespace' => 'Concave','middleware' => 'auth'], function () {
	// This is root for superadmin
		include('concave.php');
});

Route::group(['namespace' => 'Core','middleware' => 'auth'], function () {
	include('core.php');
});


//CIT Route
Route::get('products/{slug}', 'CitController@product')->name('product.view');
Route::get('package/{id}', 'CitController@package')->name('package.view');
Route::get('products', 'CitController@product_list')->name('products');
Route::get('categories/{slug}', 'CitController@categories_list')->name('categories');
Route::get('faqs', 'CitController@faqs')->name('faqs');
Route::get('career', 'CitController@career')->name('career');
Route::get('partners', 'CitController@partners')->name('partners');
Route::get('team', 'CitController@team')->name('team');
Route::get('getdistrict/{division_id}', 'CitController@getdistrict')->name('getdistrict');
Route::get('getinsurance/{id}', 'CitController@getInsuranceById')->name('getinsurance');
Route::get('getpackage/{id}', 'CitController@getPackageById')->name('getpackage');
Route::get('getinsurancetype/{id}', 'CitController@getInsuranceTypeById')->name('getinsurancetype');
Route::get('getinsurancehiddenfields/{id}', 'CitController@getinsurancehiddenfieldsById')->name('getinsurancetype');
Route::get('checkout/{id}', 'CitController@checkout')->name('checkout');

//Reset Password
Route::post('/reset-password', 'CitController@reset_password')->name('reset.password');
Route::post('/reset-password-confirmation', 'CitController@reset_password_confirmation')->name('reset.password.confirmation');


//OTP
Route::post('/generate-otp', 'CitController@generateOTP');
Route::post('/verify-otp', 'CitController@verifyOTP');

//Payment Routes

//Payment by user
Route::post('/pay', 'CitController@payment');

//Payment by Agent
Route::post('/pay-agent', 'CitController@payment_agent');

//Payment Faild
Route::get('failed/{tx_id}', 'CitController@failed')->name('failed');

//Response routes
Route::post('/response', 'CitController@response')->name('shurjopay.response');

//Mobile Number Validation
Route::post('phone-check', 'CitController@phone');
Route::post('create-agent', 'AgentController@createAgent')->name('create.agent');

//Hierarchy Tree Data
Route::post('get-hierarchy', 'AgentController@get_hierarchy')->name('get_hierarchy');

//Change Profile Picture
Route::post('change-profile-picture', 'CitController@change_profile_picture');
Route::post('user-by-hierarchy-level', 'CitController@get_user');

/*Route::get('test_mail', function(){


$x= Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
	{
		$message->to('eco13041@gmail.com');
	});

var_dump($x);


}); */

Route::get('generate-card', 'CitController@generate_card');

//bKash
Route::post('initial-state', 'BkashPaymentController@token');
Route::get('createpayment', 'BkashPaymentController@createpayment');
Route::get('executepayment', 'BkashPaymentController@executepayment');
Route::post('querypayment', 'BkashPaymentController@querypayment');
Route::post('searchpayment', 'BkashPaymentController@searchpayment');






