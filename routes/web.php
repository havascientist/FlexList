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
    return view('welcome'); // jadi dia nge return folder resources bagian views/welcome
});

Route::get('/homee', function () {
    return view('layout.master'); // jadi dia nge return folder resources bagian views/welcome
});

Route::get('/loginprofil', function () {
    return view('layout.schedule'); // jadi dia nge return folder resources bagian views/welcome
});