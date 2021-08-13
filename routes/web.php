<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/assessments/create', [App\Http\Controllers\AssessmentController::class, 'create']);
    Route::get('/assessments/create', [App\Http\Controllers\AssessmentController::class, 'create'])->name('assessment.create');
    Route::patch('/assessments/{assessment}/assessmentQuestions/{assessmentQuestion}', [App\Http\Controllers\AssessmentQuestionController::class, 'update']);
});

