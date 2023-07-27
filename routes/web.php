<?php

use App\Http\Controllers\updateSiteDataImages;
use App\Http\Controllers\web\siteDateCollection;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\Environment\Runtime;

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

Route::view('/', "welcome");

Route::resource('site-data-collection',siteDateCollection::class);

Route::resource('update-site-data-images',updateSiteDataImages::class);

Route::view('test','welcome');
Route::post('test',[siteDateCollection::class,'store']);