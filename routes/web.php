<?php

use App\Models\Complaint;
use Spatie\LaravelPdf\Enums\Format;
use Illuminate\Support\Facades\Route;
use function Spatie\LaravelPdf\Support\pdf;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\ClientConsentMiddleware;

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('language-switcher');

Auth::routes(['register'=>false, 'login'=>false]);

Route::get('/register', App\Livewire\Auth\Register::class)->name('register');
Route::get('/login', App\Livewire\Auth\Login::class)->name('login');

Route::get('/', function () {
    return redirect('login');
});

Route::any('/logout', [LoginController::class, 'logout']);

Route::group(['prefix' => 'my', 'middleware' => ['auth']], function () {

    Route::get('/evaluations', App\Livewire\Client\Evaluation\Index::class)->name('client.evaluations.index');

    Route::get('/evaluation/{code}/{response_id?}', App\Livewire\Client\Evaluation\Show::class)->name('client.evaluation.index');

    Route::get('/evaluators', App\Livewire\Client\Evaluator\Index::class)->name('client.evaluators.index');

    Route::get('/contrat-performance', App\Livewire\Client\PerformanceContract\Index::class)->name('client.performance-contract.index');

});

Route::group(['prefix' => 'my', 'middleware' => ['auth', 'role:user']], function () {
    Route::get('/dashboard', App\Livewire\Client\Dashboard\Dashboard::class)->name('client.dashboard');
    Route::get('/profile', App\Livewire\Client\Profile::class)->name('client.profile');
    // Route::get('/evaluations', App\Livewire\Client\Evaluation\Index::class)->name('client.evaluations.index');
    // Route::get('/evaluation/{code}/{response_id?}', App\Livewire\Client\Evaluation\Show::class)->name('client.evaluation.index');

    // Route::get('/evaluators', App\Livewire\Client\Evaluator\Index::class)->name('client.evaluators.index');

    Route::get('/tbord', App\Livewire\Client\Tbord\Index::class)->name('client.tbords.index');

    Route::get('/tbord/{code}', App\Livewire\Client\Tbord\Find\Index::class)->name('client.tbords.find');

    // Route::get('/contrat-performance', App\Livewire\Client\PerformanceContract\Index::class)->name('client.performance-contract.index');

    //AuditLogs
    Route::prefix('auditlogs')->group(function () {
        Route::get('/', App\Livewire\Client\AuditLogs\Index::class)->name('client.auditlogs');
    });

});

Route::group(['prefix' => 'portal', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', App\Livewire\Portal\Dashboard\Index::class)->name('portal.dashboard');
    Route::get('/profile-setting', App\Livewire\Portal\ProfileSetting::class)->name('portal.profile-setting');

    //Clients
    Route::prefix('users')->group(function () {
        Route::get('/', App\Livewire\Portal\Users\Index::class)->name('portal.users.index');
    });


    //Clients
    Route::prefix('evaluation/')->group(function () {
        Route::get('/', App\Livewire\Portal\Scorecard\Index::class)->name('portal.test.index');
        Route::get('/setting/indicator', App\Livewire\Portal\Scorecard\Indicator\Index::class)->name('portal.indicator.index');
        Route::get('/create', App\Livewire\Portal\Evaluation\Create\Index::class)->name('portal.evaluation.index');
        Route::get('/response/{code}', App\Livewire\Portal\Evaluation\Response\Index::class)->name('portal.evaluation.response');
        Route::get('/create/{evaluation}/participants', App\Livewire\Portal\Evaluation\Cible\Index::class)->name('portal.evaluation.cible');
        Route::get('/create/comitees', App\Livewire\Portal\Evaluation\Comitee\Index::class)->name('portal.comitee.cible');
        Route::get('/calibrage/{id}', App\Livewire\Portal\Evaluation\Calibrage\Index::class)->name('portal.calibrage.index');
        Route::get('/statistic/{code}', App\Livewire\Portal\Evaluation\Statistics\Index::class)->name('portal.evaluation.statistics');
    });

    //AuditLogs
    Route::prefix('auditlogs')->group(function () {
        Route::get('/', App\Livewire\Portal\AuditLogs\Index::class)->name('portal.auditlogs.index');
    });

});
