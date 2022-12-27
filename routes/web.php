<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Column_seats;
use App\Models\trip;
use App\Models\Row_seats;
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
	session()->flush();
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::post('addbus',[App\Http\Controllers\BusController::class, 'store'])->name('AddBus');

Route::post('AddRoutes',[App\Http\Controllers\RoutesController::class, 'store'])->name('AddRoutes');

Route::post('addfarediscount',[App\Http\Controllers\FareDiscounts::class, 'store'])->name('addfarediscount');

Route::post('Addschedule',[App\Http\Controllers\TravelScheduleController::class, 'store'])->name('Addschedule');

Route::post('Addtrips',[App\Http\Controllers\TravelScheduleController::class, 'storetrips'])->name('Addtrips');

Route::get('Payment/reserve/tickets',[App\Http\Controllers\TicketController::class, 'payticket'])->name('payticketregister');

Route::post('reserveticket',[App\Http\Controllers\TicketController::class, 'reserve'])->name('reserveticket');

Route::get('changeseat',[App\Http\Controllers\TicketController::class, 'changeseat'])->name('changeseat');

Route::get('mailticket',[App\Http\Controllers\MailController::class, 'mailticket'])->name('mailticket');

Route::get('actiondiscountrequest',[App\Http\Controllers\TicketController::class, 'actiondiscountrequest'])->name('actiondiscountrequest');
Route::get('Viewing/Bus/Occs',function(Request $request){


	$busid = $request->id;
	$viewingticket = $request->viewingticket;
	$reserve = $request->reserve;
	$tripid =  $request->trip_id;
	$authenticathed = $request->authenticathed;

	
	
	$bus = Bus::where('id',$request->id)->get();

	$columns = Column_seats::where('bus_id',$request->id)->get();
	$rows = Row_seats::where('bus_id',$request->id)->get();

	
	
	$ts_id = trip::findorFail($tripid)->TS_id;



	return view('viewbus',compact('columns','rows','busid','viewingticket','bus','reserve','tripid','authenticathed','ts_id'));
})->name('viewbus');

Route::get('Reserve',function(Request $request){
	session()->flush();
	return view('reserve');
})->name('reserve');

Route::get('viewusertickets',function(Request $request){
	$userid = $request->id;
	$user   = $request->user;

	return view('pages.viewtickets',compact('userid','user')); 

})->name('viewusertickets');



Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('dashboard');

Route::get('edit','App\Http\Controllers\EditController@index')->name('edit');

Route::post('update','App\Http\Controllers\UpdateController@index')->name('update');

Route::get('delete','App\Http\Controllers\DeleteController@index')->name('delete');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::patch('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::patch('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

