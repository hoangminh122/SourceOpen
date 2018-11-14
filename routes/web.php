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

Route::get('/', function () {
    return view('welcome');
});
Route::get('minh/mi',function()
{
    return "hekdhakj";
});
Route::get('about/{bien1}/{bien2}',function($bien3,$bien4) {
    return "$bien3 and $bien4";
});
Route::get('index',[
    'as'=> 'trangchu',
    'uses'=>'PageController@getIndex'
]);
Route::get('loai-sanpham/{type}',[
    'as'=>'loaisanpham',
    'uses'=>'PageController@getLoaiSp'
]);
Route::get('chi-tiet-san-pham',[
    'as'=>'chitietsanpham',
    'uses'=>'PageController@getChitiet'
]);
Route::get('lien-he',[
    'as'=>'lienhe',
    'uses'=>'PageController@getLienHe'
]);
Route::get('About',[
    'as'=>'gioithieu',
    'uses'=>'PageController@getAbout'
]);
Route::get('loai-sanpham1/{minh1}',
    [
        'as' => 'loaisanpham1',
        'uses' => 'PageController@getLoaiSp1'
    ]
);
