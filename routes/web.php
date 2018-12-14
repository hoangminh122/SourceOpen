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

//Route::get('/', function () {
    //return view('welcome');
//});
Route::get('minh/mi',function()
{
    return "hekdhakj";
});
Route::get('about/{bien1}/{bien2}',function($bien3,$bien4) {
    return "$bien3 and $bien4";
});
Route::get('/',[
    'as'=> 'trangchu',
    'uses'=>'PageController@getIndex'
]);
Route::get('loai-sanpham/{type}',[
    'as'=>'loaisanpham',
    'uses'=>'PageController@getLoaiSp'
]);
Route::get('chi-tiet-san-pham/{id}',[
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
Route::get('add-to-cart/{id}',[
    'as'=>'themgiohang',
    'uses'=>'PageController@getAddtoCart'
]);
Route::get('del-cart/{id}',[
'as'=>'xoagiohang',
'uses'=>'PageController@getDelItemCart'
]);
Route::get('dat_hang',['as'=>'dathang','uses'=>'PageController@getCheckout']);
Route::post('post-dat-hang',['as'=>'postdathang','uses'=>'PageController@postCheckout']);
Route::get('dang-nhap',[
'as'=>'login',
'uses'=>'PageController@getLogin'
]);
Route::get('dang-ki',[
'as'=>'signin',
'uses'=>'PageController@getSignin']);
Route::post('dang-ki',[
'as'=>'signin',
'uses'=>'PageController@postSignin']);
Route::post('dang-nhap',[
'as'=>'postlogin',
'uses'=>'PageController@postLogin']);
Route::get('timkiem',[
'as'=>'Search',
'uses'=>'PageController@getSearch']);
Route::get('admin_sp',['as'=>'admin_sp','uses'=>'PageController@demo']);
Route::get('admin_getaddsp',['as'=>'admin_getaddsp','uses'=>'PageController@get_add_spmoi']);
Route::post('admin_postaddsp',['as'=>'admin_postaddsp','uses'=>'PageController@post_add_spmoi']);
Route::get('admin_getupdatesp/{id}',['as'=>'admin_getupdatesp','uses'=>'PageController@get_update_spmoi']);
Route::post('admin_postupdatesp/{id}',['as'=>'admin_postupdatesp','uses'=>'PageController@post_update_spmoi']);
Route::get('admin_getdel/{id}',['as'=>'admin_getdel','uses'=>'PageController@getdel']);
Route::get('admin_getdelUser/{id}',['as'=>'admin_getdelUser','uses'=>'PageController@getdelUser']);
Route::get('user_list',['as'=>'getuser_list','uses'=>'PageController@getuser_list']);






