<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', function () {
        return redirect('/attendance');
    });

Route::get('/employees','Master\EmployeesController@get_employees');
Route::get('/employees/json','Master\EmployeesController@get_employees_json');
Route::get('/employees/delete','Master\EmployeesController@delete_employee');
Route::post('/employees','Master\EmployeesController@post_employees');

Route::get('/position','Master\PositionController@get_position');
Route::get('/position/json','Master\PositionController@get_position_json');
Route::get('/position/delete','Master\PositionController@delete_position');
Route::post('/position','Master\PositionController@post_position');

Route::get('/salary','Master\SalaryController@get_salary');
Route::get('/salary/json','Master\SalaryController@get_salary_json');
Route::get('/salary/delete','Master\SalaryController@delete_salary');
Route::post('/salary','Master\SalaryController@post_salary');

Route::get('/attendance','AttendanceController@show_att');
Route::get('/attendance/json','AttendanceController@show_att_json');
Route::post('/attendance','AttendanceController@post_att');

Route::get('/report','ReportController@show');
Route::get('/report/pdf','ReportController@get_pdf');
});


Route::get('/home', 'HomeController@index')->name('home');
