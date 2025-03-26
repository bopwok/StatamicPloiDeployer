<?php

use Illuminate\Support\Facades\Route;
use Savelend\PloiDeployer\Http\Controllers\PloiDeployController;
use Savelend\PloiDeployer\Http\Controllers\PloiConfigController;

Route::group(['middleware' => ['statamic.cp.authenticated']], function () {
    Route::post('ploi-deployer/deploy', [PloiDeployController::class, 'deploy'])->name('ploi-deployer.deploy');

    Route::get('ploi-deployer/config', [PloiConfigController::class, 'index'])->name('ploi-deployer.config.index');
    Route::post('ploi-deployer/config', [PloiConfigController::class, 'update'])->name('ploi-deployer.config.update');
});
