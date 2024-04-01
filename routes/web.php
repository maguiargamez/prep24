<?php

use App\Http\Livewire\Candidates\CandidateForm;
use App\Http\Livewire\Candidates\Candidates;
use App\Http\Livewire\Capture\PollingPlaces\RecordForm as PollingPlacesRecordForm;
use App\Http\Livewire\Capture\PollingPlaces\Records as PollingPlacesRecords;
use App\Http\Livewire\Dashboard\Dashboard;
use App\Http\Livewire\Dashboard\District;
use App\Http\Livewire\Dashboard\Section;
use App\Http\Livewire\Elections\ElectionForm;
use App\Http\Livewire\Elections\Elections;
use App\Http\Livewire\Parties\Parties;
use App\Http\Livewire\Parties\PartyForm;
use App\Http\Livewire\PollingPlaces\PollingPlaceForm;
use App\Http\Livewire\PollingPlaces\PollingPlaceImport;
use App\Http\Livewire\PollingPlaces\PollingPlaces;
use App\Http\Livewire\PollingPlaces\Records\RecordForm as RecordsRecordForm;
use App\Http\Livewire\PollingPlaces\Records\RecordsIndex;
use App\Http\Livewire\Records\Captures\RecordCaptures;
use App\Http\Livewire\Records\Captures\RecordDistrict;
use App\Http\Livewire\Records\Captures\RecordSection;
use App\Http\Livewire\Records\RecordForm;
use App\Http\Livewire\Records\Records;
//use App\Http\Livewire\Users\UserAccounts\UserAccountForm;
//use App\Http\Livewire\Users\UserAccounts\UserAccounts;
use App\Http\Livewire\Users\UserForm;
use App\Http\Livewire\Users\Users;
use App\Http\Livewire\Users\UserShow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->guest('login');
});

Auth::routes();

/*Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/



Route::middleware([
    'auth:sanctum',
    'verified'
])->group(function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('/entidad', Dashboard::class)->name('dashboard.home');
        Route::get('/distrito', District::class)->name('dashboard.district');
        Route::get('/seccion', Section::class)->name('dashboard.section');
    });

    

    Route::get('/elecciones', Elections::class)->name('elections.index');
    Route::get('/elecciones/crear', ElectionForm::class)->name('elections.create');
    Route::get('/elecciones/{election}/editar', ElectionForm::class)->name('elections.edit');

    Route::get('/partidos-coaliciones', Parties::class)->name('parties.index');
    Route::get('/partidos-coaliciones/crear', PartyForm::class)->name('parties.create');
    Route::get('/partidos-coaliciones/{party}/editar', PartyForm::class)->name('parties.edit');

    Route::get('/candidatos', Candidates::class)->name('candidates.index');
    Route::get('/candidatos/crear', CandidateForm::class)->name('candidates.create');
    Route::get('/candidatos/{candidate}/editar', CandidateForm::class)->name('candidates.edit');


    Route::get('/casillas', PollingPlaces::class)->name('polling-places.index');
    Route::get('/casillas/crear', PollingPlaceForm::class)->name('polling-places.create');
    Route::get('/casillas/{election}/editar', PollingPlaceForm::class)->name('polling-places.edit');
    Route::get('/casillas/importar', PollingPlaceImport::class)->name('polling-places.import');

    Route::get('/captura/casillas', PollingPlacesRecords::class)->name('capture.polling-places.index');
    Route::get('/captura/casillas/{pollingPlace}/acta', PollingPlacesRecordForm::class)->name('capture.records.polling-place');

    Route::prefix('actas')->group(function () {

        Route::get('/casillas', RecordsIndex::class)->name('records.polling-places.index');
        Route::get('/casillas/capturar/{cCasilla}/acta', RecordsRecordForm::class)->name('records.polling-places.record.index');

        Route::get('/', Records::class)->name('records.index');

        Route::get('/captura-informacion', RecordCaptures::class)->name('records.capture.index');
        Route::get('/captura-informacion/distrito/{pollingPlace}', RecordDistrict::class)->name('records.district.index');
        Route::get('/captura-informacion/seccion/{pollingPlace}', RecordSection::class)->name('records.section.index');
        Route::get('/captura-informacion/casilla/{pollingPlace}', RecordForm::class)->name('records.polling-place.create');
    });

    Route::prefix('super-administracion')->group(function () {

        Route::get('/usuarios', Users::class)->name('users.index');
        Route::get('/usuarios/crear', UserForm::class)->name('users.create');
        Route::get('/usuarios/informacion', UserShow::class)->name('users.show');
        Route::get('/usuarios/{user}/editar', UserForm::class)->name('users.edit');

        /*Route::get('/cuentas-usuarios', UserAccounts::class)->name('user-accounts.index');
        Route::get('/cuentas-usuarios/crear', UserAccountForm::class)->name('user-accounts.create');
        Route::get('/cuentas-usuarios/{user}/editar', UserAccountForm::class)->name('user-accounts.edit');*/
      
    });







   




});