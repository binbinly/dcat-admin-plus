<?php

use AdminPlus\Http\Controllers\SystemLogController;
use AdminPlus\Http\Controllers\ExceptionLogController;
use AdminPlus\Http\Controllers\OperationLogController;
use Illuminate\Support\Facades\Route;

Route::get('auth/logs-view', SystemLogController::class.'@index')->name('log-viewer-index');
Route::get('auth/logs-view/{file}', SystemLogController::class.'@index')->name('log-viewer-file');
Route::get('auth/logs-view/{file}/tail', SystemLogController::class.'@tail')->name('log-viewer-tail');

Route::resource('auth/exception-logs', ExceptionLogController::class)->names('exception-log');

Route::get('auth/operation-logs', OperationLogController::class.'@index')->name('operation-log-index');
Route::delete('auth/operation-logs/{id}', OperationLogController::class.'@destroy')->name('operation-log-destroy');
