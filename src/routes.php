<?php
/**
 * Created by PhpStorm.
 * AuthUser: woisk
 * Date: 2017/11/27 0027
 * Time: 22:04
 */


Route::prefix('auth')
    ->middleware('api')
    ->namespace("Woisk\Auth\Http\Controllers")
    ->group(function () {

        
        Route::any('check', "CheckController@check")->name('check');

        Route::any('reg', "RegController@registr")->name('register');

        Route::any('login', "LoginController@login")->name('login');


    });