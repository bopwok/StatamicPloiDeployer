<?php

use Illuminate\Support\Facades\Route;
use Savelend\PloiDeployer\Http\Controllers\PloiDeployController;
use Savelend\PloiDeployer\Http\Controllers\PloiConfigController;

Route::prefix('ploi-deployer')->name('ploi-deployer.')->group(function () {
    Route::post('deploy', [PloiDeployController::class, 'deploy'])->name('deploy');
    
    Route::get('config', [PloiConfigController::class, 'index'])->name('config.index');
    Route::post('config', [PloiConfigController::class, 'update'])->name('config.update');
});