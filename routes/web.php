<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Manager\EtablissementController;
use App\Http\Controllers\Manager\teachersController;
use App\Http\Controllers\Manager\SectionsController;
use App\Http\Controllers\Manager\CyclesController;
use App\Http\Controllers\Manager\subjectsController;
use App\Http\Controllers\Manager\classController;
use App\Http\Controllers\Manager\CahierdetexteClassController;
use App\Http\Controllers\Manager\CahierdetexteTeacherController;
use App\Http\Controllers\Manager\DeleteController;
use App\Http\Controllers\Manager\PeriodeController;
use App\Http\Controllers\Manager\JourController;
use App\Http\Controllers\Manager\EnseignementController;
use App\Http\Controllers\Manager\TypedecoursController;
// User Manage
use App\Http\Controllers\Manager\UserController;
use App\Http\Controllers\Manager\RoleController;
use App\Http\Controllers\Manager\PermissionController;
// 
use App\Http\Controllers\Calendrier\EmploidetempsteacherController;
use App\Http\Controllers\Calendrier\EmploidetempsclasseController;

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
    return view('home.index');
})->name('accueil');

Route::get('/portails-direction', function(){
    return view('home.direction');
})->name('portails-direction');

Route::get('/portails-enseignants', function(){
    return view('home.enseignants');
})->name('portails-enseignants');

Route::get('/portials-parents', function(){
    return view('home.parents');
})->name('portails-parents');

Route::get('/dashboard', function () {
    return view('admin_manager.sections_cycles.sections.index');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('language/{locale}',  [LocalizationController::class,'lang'])->name('langue');

Route::resources([
    'users' => UserController::class,
    'roles' => RoleController::class,
    'permissions' => PermissionController::class,
]);

Route::name('dashboard_manage.')->middleware(['auth', 'verified'])->group(function(){
    Route::resource('etablissements', EtablissementController::class); 
    Route::resource('teachers', teachersController::class);
    Route::resource('Sections', SectionsController::class);
    Route::resource('Cycles', CyclesController::class);
    Route::resource('subject', subjectsController::class);
    Route::resource('textbookClass', CahierdetexteClassController::class);
    Route::resource('textbookTeacher', CahierdetexteTeacherController::class);
    Route::get('download/{attachment_name}', [CahierdetexteClassController::class, 'downloadattachment'])->name('downloadattachment');
    Route::resource('period', PeriodeController::class);
    Route::resource('class', classController::class);
    Route::resource('type_of_lesson', TypedecoursController::class);
    Route::resource('day',JourController::class);
    Route::resource('teacher_Schedule',EmploidetempsteacherController::class);
    Route::resource('class_Schedule',EmploidetempsclasseController::class);
    Route::post('half_store',[PeriodeController::class, 'demi_store'])->name('periode.demi_store');
    Route::post('half_update/{groupeperiode_id}',[PeriodeController::class, 'demi_update'])->name('periode.demi_update');
    Route::resource('teaching', EnseignementController::class);
    Route::resource('Delete', DeleteController::class);  

});


require __DIR__.'/auth.php';
