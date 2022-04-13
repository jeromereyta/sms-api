<?php

use App\Http\Controllers\API\AdminUser\ArchiveStaffsController;
use App\Http\Controllers\API\AdminUser\EditStaffUserController;
use App\Http\Controllers\API\AdminUser\UserListController;
use App\Http\Controllers\API\Authentication\AdminLoginController;
use App\Http\Controllers\API\Authentication\RefreshTokenController;
use App\Http\Controllers\API\AdminUser\CreateStaffUserController;
use App\Http\Controllers\API\AdminUser\CurrentUserController;
use App\Http\Controllers\API\Roles\RoleListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/admin-login', [
    'uses' => AdminLoginController::class,
])->name('admin-login');

Route::post('/refresh-token', [
    'as' => 'refresh-token',
    'uses' => RefreshTokenController::class,
]);

Route::group([
    'middleware' => 'auth:api',
    'as' => 'sms.api.v1.',
    'prefix' => 'v1',

], function ($router) {
    Route::group([
        'as' => 'users.',
        'prefix' => '',
    ], function ($router) {
        Route::post('/users/staff', [
            'as' => 'create-staff',
            'uses' => CreateStaffUserController::class,
        ]);
        Route::get('/users/staff', [
            'as' => 'list-staff',
            'uses' => UserListController::class,
        ]);

        Route::get('/users/me', [
            'as' => 'users.me',
            'uses' => CurrentUserController::class,
        ]);

        Route::put('/users/staff/{id}', [
            'as' => 'edit-staff',
            'uses' => EditStaffUserController::class,
        ]);

        Route::post('/users/staff/delete', [
            'as' => 'delete-staffs',
            'uses' => ArchiveStaffsController::class,
        ]);
    });

    Route::group([
        'as' => 'roles.',
        'prefix' => '',
    ], function ($router) {
        Route::get('/roles', [
            'as' => 'list',
            'uses' => RoleListController::class,
        ]);
    });
});
