<?php

use Illuminate\Support\Facades\Route;




use App\Http\Controllers\publicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChefDeFiliereController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\FilieresController;


Route::get('/', [publicController::class, 'index']);

Route::get('login', [AuthController::class, 'showLoginForm']);

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::PUT('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Route::get('/admin/departments', [DepartmentsController::class, 'index'])->name('departments.index');
Route::post('/admin/departments', [DepartmentsController::class, 'store'])->name('departments.store');
Route::delete('/admin/departments/{id}', [DepartmentsController::class, 'destroy'])->name('departments.destroy');

Route::get('/filieres/create', [FilieresController::class, 'create'])->name('filieres.create');
Route::post('/filieres', [FilieresController::class, 'store'])->name('filieres.store');


Route::get('/etudiant', [EtudiantController::class, 'index'])->name('etudiant');

Route::get('/etudiant/select', [TimetableController::class, 'selectStudent'])->name('student.select');


Route::get('/etudiant/select/timetable', [TimetableController::class, 'Student'])->name('student.timetable');

Route::get('/professeur', [ProfesseurController::class, 'index'])->name('professeur');

Route::get('/professeur/select', [TimetableController::class, 'selectProf'])->name('prof.select');

Route::get('/professeur/select/timetable', [TimetableController::class, 'prof'])->name('prof.timetable');

Route::post('/professeur/select/timetable/{id}/send-message', [ProfesseurController::class, 'sendMessage'])->name('professor.sendMessage');



Route::get('/professeur/profile', [ProfileController::class, 'editProf'])->name('prof.profile');



Route::get('/professeur/profile', [ProfileController::class, 'update'])->name('professeur.profile.update');


Route::get('/chefdefiliere', [ChefDeFiliereController::class, 'index'])->name('chefdefiliere');

Route::get('/chefdefiliere/profile', [ProfileController::class, 'edit'])->name('chefprofile');

Route::get('/etudiant/profile', [ProfileController::class, 'edit'])->name('etudiant.profile');


Route::post('/etudiant/profile', [ProfileController::class, 'update'])->name('étudiant.profile.update');

Route::get('/etudiant/messages', [EtudiantController::class, 'showStudentMessages'])->name('etudiant.messages');


Route::get('/chefdefiliere/profile', [ProfileController::class, 'update'])->name('chef de filière.profile.update');


Route::get('/chefdefiliere/select', [TimetableController::class, 'select'])->name('creneaux.select');


Route::get('/chefdefiliere/index', [TimetableController::class, 'index'])->name('creneaux.index');


Route::post('/chefdefiliere/store', [TimetableController::class, 'store'])->name('creneaux.store');

Route::get('/chefdefiliere/messages', [ChefDeFiliereController::class, 'viewMessages'])->name('chefdefiliere.messages');

Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');

Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');

Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');

Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');

Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

Route::get('/filiere-info', function () {
    return response()->view(public_path('info-filieres.pdf'));
})->name('filiere.info');



