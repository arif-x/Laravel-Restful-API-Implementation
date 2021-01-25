<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Contact;

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


//============================ API Route with Function (If Needed with this Route Method) ============================
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('contacts', function(){
// 	return Contact::all();
// });

// Route::get('contact/{id}', function($id){
// 	return Contact::find($id);
// });

// Route::post('contact', function(Request $request){
// 	return Contact::create($request->all());
// });

// Route::put('contact/{id}', function(Request $request, $id){
// 	$contact = Contact::findOrFail($id);
// 	$contact->update($request->all());
// 	return $contact;
// });

// Route::delete('contact/{id}', function($id){
// 	Contact::find($id)->delete();
// 	return 204;
// });

//============================ API Route with Controller Function ============================
Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::group(['middleware' => 'auth:api'], function() {
	Route::get('/contact', 'ContactController@index');
	Route::get('/contact/{id}', 'ContactController@show');
	Route::post('/contact', 'ContactController@store');
	Route::put('/contact/{id}', 'ContactController@update');
	Route::delete('/contact/{id}', 'ContactController@delete');
});

//============================ Auth API Route ============================
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
