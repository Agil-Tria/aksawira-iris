<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SentenceController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\PublicCorpusController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\DictionaryValidationController;
use App\Http\Controllers\TranslateController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ContributorDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TranslationHistoryController;
use App\Http\Controllers\Admin\AdminCorpusController;
use App\Http\Controllers\Admin\AdminDictionaryController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\DictionaryImportController;
use App\Http\Controllers\DictionaryPdfImportController;
use App\Http\Controllers\DictionaryEntryImportController;
use App\Models\Sentence;
use App\Models\Dictionary;

Route::get('/', function () {

    $totalCorpus = Sentence::where(
        'status',
        'approved'
    )->count();

    $totalDictionary = Dictionary::where(
        'status',
        'approved'
    )->count();

    return view('welcome', compact(
        'totalCorpus',
        'totalDictionary'
    ));
});

Route::delete(
    '/dictionary/delete-all',
    [\App\Http\Controllers\DictionaryController::class, 'deleteAll']
)->middleware([
    'auth',
    'role:admin|validator'
])->name('dictionary.deleteAll');

Route::middleware(['auth'])
    ->group(function () {

        Route::post(
            '/dictionary/import',
            [DictionaryImportController::class, 'import']
        )->name('dictionary.import');

    });

    Route::middleware([
    'auth',
    'role:admin|validator'
])->group(function () {

    // Route::post(
    //     '/dictionary/import/xlsx',
    //     [DictionaryEntryImportController::class, 'import']
    // )->name('dictionary.import.xlsx');

});

Route::post(

    '/dictionary/import',

    [DictionaryImportController::class, 'import']

)->middleware('auth');

    Route::post(
    '/dictionary/import/pdf',
    [DictionaryPdfImportController::class, 'import']
        )->middleware('auth')
        ->name('dictionary.import.pdf');


Route::middleware([
    'auth',
    'role:admin'
])->prefix('admin')->group(function () {

    Route::get(
        '/users',
        [\App\Http\Controllers\Admin\AdminUserController::class, 'index']
    )->name('admin.users.index');

    Route::patch(
        '/users/{user}/approve',
        [\App\Http\Controllers\Admin\AdminUserController::class, 'approve']
    )->name('admin.users.approve');

});


Route::get('/corpus', [
    PublicCorpusController::class,
    'index'
])->name('public.corpus');

Route::get('/translate', [
    TranslateController::class,
    'index'
])->name('translate.index');

Route::post('/translate', [
    TranslateController::class,
    'translate'
])->name('translate.process');
Route::post(
    '/translate/live',
    [TranslateController::class, 'liveTranslate']
)->name('translate.live');

Route::get(

    '/translate/autocomplete',

    [TranslateController::class, 'autocomplete']

);

Route::middleware(['role:admin'])
    ->group(function () {

        Route::patch(
            '/admin/users/{user}/approve',
            [AdminUserController::class, 'approve']
        )->name('admin.users.approve');

    });


Route::middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get('/export/corpus/csv', [
            ExportController::class,
            'exportCorpusCsv'
        ])->name('export.corpus.csv');

        Route::get('/export/corpus/json', [
            ExportController::class,
            'exportCorpusJson'
        ])->name('export.corpus.json');

    });

    Route::middleware(['role:admin'])
    ->group(function () {

        Route::delete(
            '/admin/corpus/{sentence}',
            [AdminCorpusController::class, 'destroy']
        )->name('admin.corpus.destroy');

        Route::delete(

    '/admin/dictionary/{word}',

    [DictionaryController::class, 'destroy']

    

)->name(
    'admin.dictionary.destroy'
);

    });

    Route::middleware(['auth'])
    ->group(function () {

        Route::get('/translation-history', [
            TranslationHistoryController::class,
            'index'
        ])->name('translation.history');

    });
    
    Route::middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get('/admin-dashboard', [
            AdminDashboardController::class,
            'index'
        ])->name('admin.dashboard');

    });
    
    Route::middleware(['auth'])
    ->group(function () {

        Route::get('/contributor-dashboard', [
            ContributorDashboardController::class,
            'index'
        ])->name('contributor.dashboard');

    });

Route::middleware(['auth', 'role:validator'])
    ->group(function () {

        Route::get('/dictionary-validation', [
            DictionaryValidationController::class,
            'index'
        ])->name('dictionary.validation');

        Route::post('/dictionary-validation/{dictionary}', [
            DictionaryValidationController::class,
            'process'
        ])->name('dictionary.validation.process');

    });

Route::get('/dictionary', [
    DictionaryController::class,
    'index'
])->name('dictionary.index');

Route::middleware(['auth'])->group(function () {

    Route::get('/dictionary/create', [
        DictionaryController::class,
        'create'
    ])->name('dictionary.create');

    Route::post('/dictionary', [
        DictionaryController::class,
        'store'
    ])->name('dictionary.store');

});

Route::middleware(['auth'])->group(function () {

    Route::middleware([
    // 'role:admin|validator'
])->group(function () {

    Route::resource(
        'sentences',
        \App\Http\Controllers\SentenceController::class
    );

});

});

Route::middleware(['auth', 'role:validator'])
    ->group(function () {

        Route::get('/validation-dashboard', [
            ValidationController::class,
            'index'
        ])->name('validation.dashboard');

        Route::post('/validation/{sentence}', [
            ValidationController::class,
            'validateSentence'
        ])->name('validation.process');
    });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
