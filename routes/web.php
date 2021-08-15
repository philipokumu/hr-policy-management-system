<?php

use App\Http\Livewire\AssessmentQuestionAndAnswers;
use App\Http\Livewire\AssessmentStat;
use App\Http\Livewire\CreateUser;
use App\Http\Livewire\ShowAssessment;
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
    return redirect(route('login'));
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/assessments', ShowAssessment::class)->name('assessment.show');
    Route::get('/assessments/intro', [App\Http\Controllers\AssessmentController::class, 'create'])->name('assessment.create');
    Route::patch('/assessments/{assessment}/assessmentQuestions/{assessmentQuestion}', [App\Http\Controllers\AssessmentQuestionController::class, 'update']);

    /** Admin management */
    Route::get('/users/{user}/assessments', AssessmentStat::class)->name('user.assessment.stat');
    // Route::get('/users/{user}/assessments/{assessment}', AssessmentQuestionAndAnswers::class)->name('user.assessment.single.stat');
    Route::get('/users/create', CreateUser::class)->name('users.create');
});

