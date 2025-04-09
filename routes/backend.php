<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\HakiController;
use App\Http\Controllers\Backend\GrantController;
use App\Http\Controllers\Backend\MajorController;
use App\Http\Controllers\Backend\MemberController;
use App\Http\Controllers\Backend\JournalController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ActivityController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ConferenceController;
use App\Http\Controllers\Backend\InnovationController;
use App\Http\Controllers\Backend\PartnerController;
use App\Http\Controllers\Backend\PosterController;

Route::group(
    ['middleware' => ['auth'], 'prefix' => 'backend'],
    function () {
        Route::resource('dashboard', DashboardController::class);
        Route::resource('activity', ActivityController::class)->except('show');
        Route::resource('major', MajorController::class)->except(['show']);
        Route::resource('member', MemberController::class)->except('show');
        Route::resource('conference', ConferenceController::class)->except('show');
        Route::resource('journal', JournalController::class)->except('show');
        Route::resource('book', BookController::class)->except('show');
        Route::resource('haki', HakiController::class)->except('show');
        Route::resource('innovation', InnovationController::class)->except('show');
        Route::resource('grant', GrantController::class)->except('show');
        Route::resource('poster', PosterController::class)->only('index', 'store', 'update');
        Route::resource('partner', PartnerController::class)->except('show');

        // Profile
        Route::get('profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile/{user}/edit', [ProfileController::class, 'update'])->name('profile.update');
        // Password
        Route::get('password/{id}/change', [ProfileController::class, 'passwordEdit'])->name('profile.password.edit');
        Route::patch('password/{id}/change', [ProfileController::class, 'changePassword'])->name('profile.password.change');
    }
);
