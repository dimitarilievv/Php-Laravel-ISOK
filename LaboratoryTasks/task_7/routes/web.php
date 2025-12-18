<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourseController::class, 'index'])->name('home');

Route::resource('courses', CourseController::class);

Route::post('/feedbacks', [FeedbackController::class, 'store'])->name('feedbacks.store');
Route::get('/feedbacks/{feedback}', [FeedbackController::class, 'show'])->name('feedbacks.show');

Route::patch('/feedbacks/{feedback}/status/{status}', [FeedbackController::class, 'changeStatus'])->name('feedbacks.changeStatus');

Route::get('/courses/{course}/feedbacks/status/{status}', [FeedbackController::class, 'filterByStatus'])->name('courses.feedbacks.filter');
