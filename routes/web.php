<?php

use App\Models\RegistrationSetting;
use Illuminate\Support\Facades\Auth;

use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\Admin\TimelineController;
use App\Http\Controllers\Admin\CriticismController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\CabinetUserController;
use App\Http\Controllers\User\HomepageUserController;
use App\Http\Controllers\User\TimelineUserController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\User\CriticismUserController;
use App\Http\Controllers\Admin\DocumentationController;
use App\Http\Controllers\Admin\MeetingStatusController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\MemberAdmissionController;
use App\Http\Controllers\User\RegistrationUserController;
use App\Http\Controllers\Admin\Settings\SettingController;
use App\Http\Controllers\User\DocumentationUserController;
use App\Http\Controllers\User\VisionMissionUserController;
use App\Http\Controllers\Admin\Settings\FooterSettingController;
use App\Http\Controllers\Admin\Settings\GlobalSettingController;
use App\Http\Controllers\Admin\Settings\CabinetSettingController;
use App\Http\Controllers\Admin\Settings\HomepageSettingController;
use App\Http\Controllers\Admin\Settings\RegistrationSettingController;
use App\Http\Controllers\Admin\Settings\VisionMissionSettingController;

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

Auth::routes([
    'register' => false
]);

Route::get('/pendaftaran-anggota', [RegistrationUserController::class, 'index'])->name('pendaftaran-anggota');
Route::post('/pendaftaran/store', [RegistrationUserController::class, 'store'])->name('storePendaftaran');

Route::resource('/', HomepageUserController::class);
Route::resource('visi-misi', VisionMissionUserController::class);
Route::resource('kabinet', CabinetUserController::class);
Route::resource('kegiatan', TimelineUserController::class);
Route::resource('dokumentasi-kegiatan', DocumentationUserController::class);
Route::resource('kritik-dan-saran', CriticismUserController::class);

// Auth User
Route::group(['middleware' => ['auth']], function () {

    // Route Dashboard
    Route::resource('dashboard', DashboardController::class);

    // Route Dokumentasi
    Route::resource('dokumentasi', DocumentationController::class);

    // Route Timeline
    Route::resource('timeline', TimelineController::class);

    // Route Meeting
    Route::resource('rapat', MeetingController::class);
    Route::resource('rapat-status', MeetingStatusController::class);

    // Route Aspirasi, Kritik Dan Saran
    Route::resource('aspirasi', CriticismController::class);

    // Route Pendaftaran Anggota BEM
    Route::resource('pendaftaran', RegistrationController::class);
    Route::resource('penerimaan', MemberAdmissionController::class);

    // Route Quotes
    Route::resource('quotes', QuoteController::class);

    // Route Role
    Route::resource('role', RoleController::class);

    // Route User
    Route::resource('user', UserController::class);

    // Route Ganti Password
    Route::resource('ganti-password', ChangePasswordController::class);

    // Route Setting
    Route::prefix('settings')->group(function () {
        Route::resource('list', SettingController::class);
        Route::resource('registration-setting', RegistrationSettingController::class);
        Route::resource('homepage-setting', HomepageSettingController::class);
        Route::resource('vision-mission-setting', VisionMissionSettingController::class);
        Route::resource('cabinet-setting', CabinetSettingController::class);
        Route::resource('global-setting', GlobalSettingController::class);
        Route::resource('footer-setting', FooterSettingController::class);
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
