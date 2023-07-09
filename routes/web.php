<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PiaController;

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

Route::get('/', [PiaController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/dashboard', [PiaController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('test', [PiaController::class, 'test']);
    Route::post('view_pia', [PiaController::class, 'view_pia']);
    
    Route::post('delete_dataflow', [PiaController::class, 'delete_dataflow']);
    Route::post('delete_riskassessment', [PiaController::class, 'delete_riskassessment']);

    Route::get('finish', [PiaController::class, 'finish']);
    
    
    Route::get('/pialist', [PiaController::class, 'pialist']);


    Route::post('/proceed_to_start', [PiaController::class, 'proceed_to_start']);
    Route::get('/proceed_to_start', [PiaController::class, 'proceed_to_start']);
    Route::post('/proceed_to_process', [PiaController::class, 'proceed_to_process']);
    Route::get('/proceed_to_process', [PiaController::class, 'proceed_to_process']);
    Route::post('/proceed_to_risk_assessment', [PiaController::class, 'proceed_to_risk_assessment']);
    Route::get('/proceed_to_risk_assessment', [PiaController::class, 'proceed_to_risk_assessment']);
    Route::post('/proceed_to_flowchart', [PiaController::class, 'proceed_to_flowchart']);
    Route::get('/proceed_to_flowchart', [PiaController::class, 'proceed_to_flowchart']);
    Route::get('/proceed_to_end', [PiaController::class, 'proceed_to_end']);
    Route::post('proceed_to_end', [PiaController::class, 'proceed_to_end']);
    
    Route::get('/system_description', [PiaController::class, 'proceed_to_system_description']);
    Route::get('/proceed_to_threshold_analysis', [PiaController::class, 'proceed_to_threshold_analysis']);
    Route::post('proceed_to_threshold_analysis', [PiaController::class, 'proceed_to_threshold_analysis']);
    Route::get('/proceed_to_data_flows', [PiaController::class, 'proceed_to_data_flows']);
    Route::post('proceed_to_data_flows', [PiaController::class, 'proceed_to_data_flows']);
    Route::get('/proceed_to_privacy_impact_analysis', [PiaController::class, 'proceed_to_privacy_impact_analysis']);
    Route::post('proceed_to_privacy_impact_analysis', [PiaController::class, 'proceed_to_privacy_impact_analysis']);
    Route::get('/proceed_to_privacy_risk_management', [PiaController::class, 'proceed_to_privacy_risk_management']);
    Route::post('proceed_to_privacy_risk_management', [PiaController::class, 'proceed_to_privacy_risk_management']);
    Route::get('/proceed_to_recommended_privacy_solutions', [PiaController::class, 'proceed_to_recommended_privacy_solutions']);
    Route::post('proceed_to_recommended_privacy_solutions', [PiaController::class, 'proceed_to_recommended_privacy_solutions']);
});

Route::post('InsertPrivacyImpactAssessment', [PiaController::class, 'InsertPrivacyImpactAssessment']);
Route::post('InsertProcess', [PiaController::class, 'InsertProcess']);
Route::post('InsertDataFlow', [PiaController::class, 'InsertDataFlow'])->name('InsertDataFlow');
Route::post('InsertRiskAssessment', [PiaController::class, 'InsertRiskAssessment'])->name('InsertRiskAssessment');
Route::post('InsertDataFields', [PiaController::class, 'InsertDataFields']);

Route::get('InsertPrivacyImpactAssessment', [PiaController::class, 'proceed_to_start']);
Route::get('InsertProcess', [PiaController::class, 'proceed_to_process']);
Route::get('InsertDataFlow', [PiaController::class, 'proceed_to_flowchart'])->name('InsertDataFlow');
Route::get('InsertRiskAssessment', [PiaController::class, 'proceed_to_risk_assessment'])->name('InsertRiskAssessment');
Route::get('InsertDataFields', [PiaController::class, 'proceed_to_process']);

require __DIR__.'/auth.php';
