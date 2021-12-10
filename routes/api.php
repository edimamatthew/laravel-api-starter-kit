<?php

use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
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

Route::middleware('auth:api')->group(function (Router $route) {

        $route->get('/me', function (Request $request) {
            return new UserResource($request->user());
        });
    
    $route->post('/password/reset', [ForgotPasswordController::class, 'reset']);

    $route->post('/logout', 'Api\LogoutController');
});

Route::post('/register', 'Api\RegisterController');
Route::post('/login', 'Api\LoginController');

Route::middleware([])->group(function (Router $route) {
    $route->post('/password/forgot', [ForgotPasswordController::class, 'forgot']);
    $route->post('/password/verify', [ForgotPasswordController::class, 'verify']);
});
