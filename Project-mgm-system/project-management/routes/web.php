<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AttachmentController;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $projects = Project::with(['creator', 'tasks'])
        ->latest()
        ->take(5)
        ->get();
    
    $tasks = Task::with(['project', 'assignee', 'creator'])
        ->latest()
        ->take(5)
        ->get();
    
    return view('dashboard', compact('projects', 'tasks'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Project Routes
    Route::resource('projects', ProjectController::class);

    // Task Routes
    Route::resource('tasks', TaskController::class);

    // Comment Routes
    Route::post('comments/{type}/{id}', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Attachment Routes
    Route::post('attachments/{type}/{id}', [AttachmentController::class, 'store'])->name('attachments.store');
    Route::delete('attachments/{attachment}', [AttachmentController::class, 'destroy'])->name('attachments.destroy');
    Route::get('attachments/{attachment}/download', [AttachmentController::class, 'download'])->name('attachments.download');
});

require __DIR__.'/auth.php';
