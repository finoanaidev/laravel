<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthentificationController;
use App\Models\Etudiant;
use App\Http\Controllers\EtudiantController;
use App\Http\Middleware\EtudiantMiddleware;




// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/etudiants/niveau', [EtudiantController::class, 'niveau']);
Route::get('/etudiants/niveau2', [EtudiantController::class, 'niveau2']);
Route::get('/etudiants/niveau3', [EtudiantController::class, 'niveau3']);
Route::get('/etudiants/niveau4', [EtudiantController::class, 'niveau4']);
Route::get('/etudiants/niveau5', [EtudiantController::class, 'niveau5']);
//Route::get('/etudiants', [EtudiantController::class, 'index']);
Route::post('/etudiants', [EtudiantController::class, 'search']);
Route::post('/etudiants/store', [EtudiantController::class, 'store']);
Route::get('/etudiants/{id}', [EtudiantController::class, 'show']);
Route::post('/register', [AuthentificationController::class, 'register']);
Route::post('/login', [AuthentificationController::class, 'login']);

Route::delete('/delete/{id}',[ EtudiantController::class, 'destroy'] );
Route::put('/update/{id}',[ EtudiantController::class, 'update'] );
Route::get('/edit/{id}',[ EtudiantController::class, 'edit'] );
Route::get('/masculin',[ EtudiantController::class, 'masculin'] );
Route::get('/feminin',[ EtudiantController::class, 'feminin'] );
Route::get('/abandon',[ EtudiantController::class, 'abandon'] );
Route::get('/masculinL1',[ EtudiantController::class, 'masculinL1'] );
Route::get('/masculinL2',[ EtudiantController::class, 'masculinL2'] );
Route::get('/masculinL3',[ EtudiantController::class, 'masculinL3'] );
Route::get('/masculinM1',[ EtudiantController::class, 'masculinM1'] );
Route::get('/masculinM2',[ EtudiantController::class, 'masculinM2'] );
Route::get('/femininL1',[ EtudiantController::class, 'femininL1'] );
Route::get('/femininL2',[ EtudiantController::class, 'femininL2'] );
Route::get('/femininL3',[ EtudiantController::class, 'femininL3'] );
Route::get('/femininM1',[ EtudiantController::class, 'femininM1'] );
Route::get('/femininM2',[ EtudiantController::class, 'femininM2'] );
Route::get('/cybfeminin',[ EtudiantController::class, 'cybfeminin'] );
Route::get('/rsifeminin',[ EtudiantController::class, 'rsifeminin'] );
Route::get('/msifeminin',[ EtudiantController::class, 'msifeminin'] );
Route::get('/devfeminin',[ EtudiantController::class, 'devfeminin'] );
Route::get('/statistique',[ EtudiantController::class,'statistique']);