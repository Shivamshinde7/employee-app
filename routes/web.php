<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;



Route::get('/', [EmployeeController::class, 'index'])->name('dashboard');

Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
Route::post('/departments/store', [DepartmentController::class, 'store'])->name('departments.store');
Route::get('/departments/{id}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
Route::post('/departments/{id}/update', [DepartmentController::class, 'update'])->name('departments.update');
Route::get('/departments/{id}/delete', [DepartmentController::class, 'destroy'])->name('departments.delete');


Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');          
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');  
Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');     
Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit'); 
Route::post('/employees/{id}/update', [EmployeeController::class, 'update'])->name('employees.update'); 
Route::get('/employees/{id}/delete', [EmployeeController::class, 'destroy'])->name('employees.delete'); 

Route::get('/employees/filter', [EmployeeController::class, 'filter'])->name('employees.filter');
Route::get('/employees/search', [EmployeeController::class, 'search'])->name('employees.search');

Route::get('/employee-graph', [EmployeeController::class, 'getEmployeeGraphData'])->name('employees.graph.data');
Route::get('/employee-graph/{date}', [EmployeeController::class, 'getEmployeesByDate'])->name('employees.byDate');

Route::fallback(function () {
    return redirect()->route('dashboard');
});
