<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['statamic.cp.authenticated'], 'namespace' => 'Savelend\PloiDeployer\Http\Controllers'], function() {
    Route::post('ploi-deployer/deploy', 'PloiDeployController@deploy')->name('ploi-deployer.deploy');

    Route::get('ploi-deployer/config', 'PloiConfigController@index')->name('ploi-deployer.config.index');
    Route::post('ploi-deployer/config', 'PloiConfigController@update')->name('ploi-deployer.config.update');
});
