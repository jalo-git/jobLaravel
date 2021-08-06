<?php
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\ResumeController;



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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/logout', [RegisterController::class, 'logout']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [RegisterController::class, 'login']);
Route::post('/create', [CreateController::class, 'create']);
Route::get('/create/jobs', [CreateController::class, 'getAllJobs']);
Route::delete('/delete/{user}', [CreateController::class, 'destroy']);


Route::get('/update/{id}', [CreateController::class, 'getUpadateById']);
Route::put('/updated/{id}', [CreateController::class, 'updatedJob']);


Route::post('/resume/create/{user}/{jobId}', [ResumeController::class,'store']); //
Route::get('/resume/user', [ResumeController::class, 'getApplicants']); 
Route::delete('/resume/delete/{id}', [ResumeController::class, 'deleteApplicants']);     


