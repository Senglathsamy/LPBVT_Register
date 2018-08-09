<?php

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

Route::get('/', function () {
    if (Auth::check()) {
        $std = \App\Student::query()->where('st_status', 1)->count(); $teacher = \App\Teacher::query()->count();
        $subject= \App\Subject::query()->count(); $users = \App\User::query()->count();
        return view('home', ['std'=> $std, 'teacher' => $teacher, 'subject' => $subject, 'users' => $users]);
    }
    return view('auth.login');
});
Auth::routes();
Route::get('/home', 'HomeController@index');

//Route Users
Route::group(['prefix' => 'users'], function() {
    Route::get('/', [ 'as' => 'users.index', 'uses' => 'UserController@index','middleware' => ['permission:user-list|user-create|user-edit|user-delete']]);
    Route::get('/create', [ 'as' => 'users.create', 'uses' => 'UserController@create','middleware' => ['permission:user-create']]);
    Route::get('/{id}', ['as' => 'users.show', 'uses' => 'UserController@show','middleware' => ['permission:user-list']]);
    Route::post('/', [ 'as' => 'users.store', 'uses' => 'UserController@store','middleware' => ['permission:user-create']]);
    Route::get('/{id}/edit',['as' => 'users.edit', 'uses' => 'UserController@edit','middleware' => ['permission:user-edit']]);
    Route::patch('/{id}',['as' => 'users.update', 'uses' => 'UserController@update','middleware' => ['permission:user-edit']]);
    Route::delete('/{id}',['as' => 'users.destroy', 'uses' => 'UserController@destroy','middleware' => ['permission:user-delete']]);
    //Route::resource('/users','UserController');
});

//Route Role Permission
Route::group(['prefix' => 'role'], function (){
    Route::get('/', [ 'as' => 'role.index', 'uses' => 'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
    Route::get('/create', [ 'as' => 'role.create', 'uses' => 'RoleController@create','middleware' => ['permission:role-create']]);
    Route::get('/{id}', ['as' => 'role.show', 'uses' => 'RoleController@show','middleware' => ['permission:role-list']]);
    Route::post('/', [ 'as' => 'role.store', 'uses' => 'RoleController@store','middleware' => ['permission:role-create']]);
    Route::get('/{id}/edit',['as' => 'role.edit', 'uses' => 'RoleController@edit','middleware' => ['permission:role-edit']]);
    Route::patch('/{id}',['as' => 'role.update', 'uses' => 'RoleController@update','middleware' => ['permission:role-edit']]);
    Route::delete('/{id}',['as' => 'role.destroy', 'uses' => 'RoleController@destroy','middleware' => ['permission:role-delete']]);
    //Route::resource('/role','RoleController');
});

//Route Province
Route::group(['prefix' => 'province'], function (){

});

//Route District
Route::group(['prefix' => 'district'], function (){
    Route::get('/getby/{id}', 'DistrictController@getDistrictByProvince');
});

//Route Student
Route::group(['prefix' => 'student'], function (){
    Route::get('/', [ 'as' => 'student.index', 'uses' => 'StudentController@index','middleware' => ['permission:student-list|student-create|student-edit|student-delete']]);
    Route::get('/create', [ 'as' => 'student.create', 'uses' => 'StudentController@create','middleware' => ['permission:student-create']]);
    Route::get('/{id}', ['as' => 'student.show', 'uses' => 'StudentController@show','middleware' => ['permission:student-list']]);
    Route::post('/', [ 'as' => 'student.store', 'uses' => 'StudentController@store','middleware' => ['permission:student-create']]);
    Route::get('/{id}/edit',['as' => 'student.edit', 'uses' => 'StudentController@edit','middleware' => ['permission:student-edit']]);
    Route::patch('/{id}',['as' => 'student.update', 'uses' => 'StudentController@update','middleware' => ['permission:student-edit']]);
    Route::delete('/{id}',['as' => 'student.destroy', 'uses' => 'StudentController@destroy','middleware' => ['permission:student-delete']]);
    Route::get('/student_print/{id}', ['uses' => 'StudentController@printInfo','middleware' => ['permission:student-list']]);
//Route::resource('/student', 'StudentController');
});
Route::post('importExcelStudent', ['uses' => 'ImportExcelController@importExcelStudent','middleware' => ['permission:student-create']]);

//Route Teacher
Route::group(['prefix' => 'teacher'], function (){
    Route::get('/', [ 'as' => 'teacher.index', 'uses' => 'TeacherController@index','middleware' => ['permission:teacher-list|teacher-create|teacher-edit|teacher-delete']]);
    Route::get('/create', [ 'as' => 'teacher.create', 'uses' => 'TeacherController@create','middleware' => ['permission:teacher-create']]);
    Route::get('/{id}', ['as' => 'teacher.show', 'uses' => 'TeacherController@show','middleware' => ['permission:teacher-list']]);
    Route::post('/', [ 'as' => 'teacher.store', 'uses' => 'TeacherController@store','middleware' => ['permission:teacher-create']]);
    Route::get('/{id}/edit',['as' => 'teacher.edit', 'uses' => 'TeacherController@edit','middleware' => ['permission:teacher-edit']]);
    Route::patch('/{id}',['as' => 'teacher.update', 'uses' => 'TeacherController@update','middleware' => ['permission:teacher-edit']]);
    Route::delete('/{id}',['as' => 'teacher.destroy', 'uses' => 'TeacherController@destroy','middleware' => ['permission:teacher-delete']]);
//Route::resource('/teacher', 'TeacherController');
});

//Route Department
Route::group(['prefix' => 'dept'], function (){
    Route::get('/', [ 'as' => 'dept.index', 'uses' => 'DepartmentController@index','middleware' => ['permission:dept-list|dept-create|dept-edit|dept-delete']]);
    Route::get('/create', [ 'as' => 'dept.create', 'uses' => 'DepartmentController@create','middleware' => ['permission:dept-create']]);
    Route::get('/{id}', ['as' => 'dept.show', 'uses' => 'DepartmentController@show','middleware' => ['permission:dept-list']]);
    Route::post('/', [ 'as' => 'dept.store', 'uses' => 'DepartmentController@store','middleware' => ['permission:dept-create']]);
    Route::get('/{id}/edit',['as' => 'dept.edit', 'uses' => 'DepartmentController@edit','middleware' => ['permission:dept-edit']]);
    Route::patch('/{id}',['as' => 'dept.update', 'uses' => 'DepartmentController@update','middleware' => ['permission:dept-edit']]);
    Route::delete('/{id}',['as' => 'dept.destroy', 'uses' => 'DepartmentController@destroy','middleware' => ['permission:dept-delete']]);
//Route::resource('/dept', 'DepartmentController');
});

//Route Major
Route::group(['prefix' => 'major'], function (){
    Route::get('/', [ 'as' => 'major.index', 'uses' => 'MajorController@index','middleware' => ['permission:major-list|major-create|major-edit|major-delete']]);
    Route::get('/getby/{id}', 'MajorController@getMajorByDepartment');
    Route::get('/create', [ 'as' => 'major.create', 'uses' => 'MajorController@create','middleware' => ['permission:major-create']]);
    Route::get('/{id}', ['as' => 'major.show', 'uses' => 'MajorController@show','middleware' => ['permission:major-list']]);
    Route::post('/', [ 'as' => 'major.store', 'uses' => 'MajorController@store','middleware' => ['permission:major-create']]);
    Route::get('/{id}/edit',['as' => 'major.edit', 'uses' => 'MajorController@edit','middleware' => ['permission:major-edit']]);
    Route::patch('/{id}',['as' => 'major.update', 'uses' => 'MajorController@update','middleware' => ['permission:major-edit']]);
    Route::delete('/{id}',['as' => 'major.destroy', 'uses' => 'MajorController@destroy','middleware' => ['permission:major-delete']]);
//Route::resource('/major', 'MajorController');
});

//Route Degree
Route::group(['prefix' => 'degree'], function (){
    Route::get('/', [ 'as' => 'degree.index', 'uses' => 'DegreeController@index','middleware' => ['permission:degree-list|degree-create|degree-edit|degree-delete']]);
    Route::get('/create', [ 'as' => 'degree.create', 'uses' => 'DegreeController@create','middleware' => ['permission:degree-create']]);
    Route::get('/{id}', ['as' => 'degree.show', 'uses' => 'DegreeController@show','middleware' => ['permission:degree-list']]);
    Route::post('/', [ 'as' => 'degree.store', 'uses' => 'DegreeController@store','middleware' => ['permission:degree-create']]);
    Route::get('/{id}/edit',['as' => 'degree.edit', 'uses' => 'DegreeController@edit','middleware' => ['permission:degree-edit']]);
    Route::patch('/{id}',['as' => 'degree.update', 'uses' => 'DegreeController@update','middleware' => ['permission:degree-edit']]);
    Route::delete('/{id}',['as' => 'degree.destroy', 'uses' => 'DegreeController@destroy','middleware' => ['permission:degree-delete']]);
//Route::resource('/degree', 'DegreeController');
});

//Route Subject
Route::group(['prefix' => 'subject'], function (){
    Route::get('/', [ 'as' => 'subject.index', 'uses' => 'SubjectController@index','middleware' => ['permission:subject-list|subject-create|subject-edit|subject-delete']]);
    Route::get('/create', [ 'as' => 'subject.create', 'uses' => 'SubjectController@create','middleware' => ['permission:subject-create']]);
    Route::get('/{id}', ['as' => 'subject.show', 'uses' => 'SubjectController@show','middleware' => ['permission:subject-list']]);
    Route::post('/', [ 'as' => 'subject.store', 'uses' => 'SubjectController@store','middleware' => ['permission:subject-create']]);
    Route::get('/{id}/edit',['as' => 'subject.edit', 'uses' => 'SubjectController@edit','middleware' => ['permission:subject-edit']]);
    Route::patch('/{id}',['as' => 'subject.update', 'uses' => 'SubjectController@update','middleware' => ['permission:subject-edit']]);
    Route::delete('/{id}',['as' => 'subject.destroy', 'uses' => 'SubjectController@destroy','middleware' => ['permission:subject-delete']]);
//Route::resource('/subject', 'SubjectController');
});

//Route Subject Major Degree (Course)
Route::group(['prefix' => 'sub_major'], function (){
    Route::get('/', [ 'as' => 'sub_major.index', 'uses' => 'MajorSubjectController@index','middleware' => ['permission:course-list|course-create|course-edit|course-delete']]);
    Route::post('/select-ajax', ['as'=>'select-ajax','uses'=>'MajorSubjectController@selectAjax','middleware' => ['permission:course-create']]);
    Route::get('/create', [ 'as' => 'sub_major.create', 'uses' => 'MajorSubjectController@create','middleware' => ['permission:course-create']]);
    Route::get('/{id}', ['as' => 'sub_major.show', 'uses' => 'MajorSubjectController@show','middleware' => ['permission:course-list']]);
    Route::post('/', [ 'as' => 'sub_major.store', 'uses' => 'MajorSubjectController@store','middleware' => ['permission:course-create']]);
    Route::get('/{id}/edit',['as' => 'sub_major.edit', 'uses' => 'MajorSubjectController@edit','middleware' => ['permission:course-edit']]);
    Route::patch('/{id}',['as' => 'sub_major.update', 'uses' => 'MajorSubjectController@update','middleware' => ['permission:course-edit']]);
    Route::delete('/{id}',['as' => 'sub_major.destroy', 'uses' => 'MajorSubjectController@destroy','middleware' => ['permission:course-delete']]);
//Route::resource('/sub_major', 'MajorSubjectController');
});

//Route Group Teacher To Subject
Route::group(['prefix' => 'teacher_subject'], function (){
    Route::get('/', [ 'as' => 'teacher_subject.index', 'uses' => 'TeacherSubjectController@index','middleware' => ['permission:teacher-subject-list|teacher-subject-create|teacher-subject-edit|teacher-subject-delete']]);
    Route::get('/create', [ 'as' => 'teacher_subject.create', 'uses' => 'TeacherSubjectController@create','middleware' => ['permission:teacher-subject-create']]);
    Route::get('/{id}', ['as' => 'teacher_subject.show', 'uses' => 'TeacherSubjectController@show','middleware' => ['permission:teacher-subject-list']]);
    Route::post('/', [ 'as' => 'teacher_subject.store', 'uses' => 'TeacherSubjectController@store','middleware' => ['permission:teacher-subject-create']]);
    Route::get('/{id}/edit',['as' => 'teacher_subject.edit', 'uses' => 'TeacherSubjectController@edit','middleware' => ['permission:teacher-subject-edit']]);
    Route::patch('/{id}',['as' => 'teacher_subject.update', 'uses' => 'TeacherSubjectController@update','middleware' => ['permission:teacher-subject-edit']]);
    Route::delete('/{id}',['as' => 'teacher_subject.destroy', 'uses' => 'TeacherSubjectController@destroy','middleware' => ['permission:teacher-subject-delete']]);
    Route::get('/dept/{id}',['as' => 'teacher_subject.getTeacherByDept', 'uses' => 'TeacherSubjectController@getTeacherByDept']);
//Route::resource('/teacher_subject', 'TeacherSubjectController');
});
//Route::get('/sub_major', 'MajorSubjectController@index');

//Route Register to learn
Route::group(['prefix' => 'register'], function (){
    Route::get('/', [ 'as' => 'register.index', 'uses' => 'RegisterController@index','middleware' => ['permission:register-list|register-create|register-edit|register-delete']]);
    Route::get('/list', [ 'as' => 'register.list', 'uses' => 'RegisterController@list','middleware' => ['permission:register-list|register-create|register-edit|register-delete']]);

    Route::post('/create', [ 'as' => 'register.create', 'uses' => 'RegisterController@create','middleware' => ['permission:register-create']]);
    Route::get('/{id}', ['as' => 'register.show', 'uses' => 'RegisterController@show','middleware' => ['permission:register-list']]);
    Route::post('/array', [ 'as' => 'register.storeMulti', 'uses' => 'RegisterController@storeMulti','middleware' => ['permission:register-create']]);
    Route::post('/', [ 'as' => 'register.store', 'uses' => 'RegisterController@store','middleware' => ['permission:register-create']]);
    Route::get('/{id}/edit',['as' => 'register.edit', 'uses' => 'RegisterController@edit','middleware' => ['permission:register-edit']]);
    Route::patch('/{id}',['as' => 'register.update', 'uses' => 'RegisterController@update','middleware' => ['permission:register-edit']]);
    Route::delete('/{id}',['as' => 'register.destroy', 'uses' => 'RegisterController@destroy','middleware' => ['permission:register-delete']]);
    Route::delete('/',['as' => 'register.multiple-delete', 'uses' => 'RegisterController@destroyMultiple','middleware' => ['permission:register-delete']]);
    Route::get('/dept_select/{id}', ['uses' => 'RegisterController@deptSelect','middleware' => ['permission:register-list']]);
    Route::get('/year/{id}', 'RegisterController@getStudyYear');
    Route::get('/system/{id}', 'RegisterController@getSystem');

//Route::resource('/register', 'RegisterController');
});
Route::post('importExcelRegister', ['uses' => 'ImportExcelController@importExcelRegister','middleware' => ['permission:register-create']]);

//Route Choose Class Room
Route::group(['prefix' => 'manage/class'], function (){
    Route::get('/', [ 'as' => 'manage_class.index', 'uses' => 'ManageClassController@index','middleware' => ['permission:manage-classroom']]);
    Route::get('/create', [ 'as' => 'manage_class.create', 'uses' => 'ManageClassController@create','middleware' => ['permission:manage-classroom']]);
    Route::get('/{id}', ['as' => 'manage_class.enroll', 'uses' => 'ManageClassController@enroll','middleware' => ['permission:manage-classroom']]);
    Route::post('/enroll/{id}', ['as' => 'manage_class.enrollEdit', 'uses' => 'ManageClassController@enrollEdit','middleware' => ['permission:manage-classroom']]);
    Route::post('/', [ 'as' => 'manage_class.store', 'uses' => 'ManageClassController@store','middleware' => ['permission:manage-classroom']]);
    Route::get('/{id}/edit',['as' => 'manage_class.edit', 'uses' => 'ManageClassController@edit','middleware' => ['permission:manage-classroom']]);
    Route::patch('/',['as' => 'manage_class.update', 'uses' => 'ManageClassController@update','middleware' => ['permission:manage-classroom']]);
    Route::post('/teach/',['as' => 'manage_class.updateTeach', 'uses' => 'ManageClassController@updateTeach','middleware' => ['permission:manage-classroom']]);
    Route::get('/sub/{id}',['as' => 'manage_class.getTeacher', 'uses' => 'ManageClassController@getTeacher','middleware' => ['permission:manage-classroom']]);
    Route::delete('/{id}',['as' => 'manage_class.destroy', 'uses' => 'ManageClassController@destroy','middleware' => ['permission:manage-classroom']]);

});

//Route Choose Teacher to teach Subject
Route::group(['prefix' => 'manage_teach_score'], function (){
    Route::get('/', [ 'as' => 'manage_teach_score.index', 'uses' => 'ManageTeacherScoreController@index','middleware' => ['permission:manage-classroom']]);
    Route::get('/create', [ 'as' => 'manage_teach_score.create', 'uses' => 'ManageTeacherScoreController@create','middleware' => ['permission:manage-classroom']]);
    Route::get('/{id}', ['as' => 'manage_teach_score.show', 'uses' => 'ManageTeacherScoreController@show','middleware' => ['permission:manage-classroom']]);
    Route::post('/', [ 'as' => 'manage_teach_score.store', 'uses' => 'ManageTeacherScoreController@store','middleware' => ['permission:manage-classroom']]);
    Route::get('/{id}/edit',['as' => 'manage_teach_score.edit', 'uses' => 'ManageTeacherScoreController@edit','middleware' => ['permission:manage-classroom']]);
    Route::patch('/{id}',['as' => 'manage_teach_score.update', 'uses' => 'ManageTeacherScoreController@update','middleware' => ['permission:manage-classroom']]);
    Route::delete('/{id}',['as' => 'manage_teach_score.destroy', 'uses' => 'ManageTeacherScoreController@destroy','middleware' => ['permission:manage-classroom']]);
//Route::resource('/manage_teach_score', 'ManageTeacherScoreController');
});

//Route Register Upgrade
Route::group(['prefix' => 'upgrade'], function (){
    Route::get('/', [ 'as' => 'upgrade.index', 'uses' => 'UpgradeController@index','middleware' => ['permission:upgrade-list|upgrade-create|upgrade-edit|upgrade-delete']]);
    Route::get('/create', [ 'as' => 'upgrade.create', 'uses' => 'UpgradeController@create','middleware' => ['permission:upgrade-create']]);
    Route::get('/{id}', ['as' => 'upgrade.show', 'uses' => 'UpgradeController@show','middleware' => ['permission:upgrade-list']]);
    Route::post('/', [ 'as' => 'upgrade.store', 'uses' => 'UpgradeController@store','middleware' => ['permission:upgrade-create']]);
    Route::get('/{id}/edit',['as' => 'upgrade.edit', 'uses' => 'UpgradeController@edit','middleware' => ['permission:upgrade-edit']]);
    Route::patch('/{id}',['as' => 'upgrade.update', 'uses' => 'UpgradeController@update','middleware' => ['permission:upgrade-edit']]);
    Route::delete('/{id}',['as' => 'upgrade.destroy', 'uses' => 'UpgradeController@destroy','middleware' => ['permission:upgrade-delete']]);
//Route::resource('/upgrade', 'UpgradeController');
});
Route::get('/check_upgrade/before_create/{ma_id}', ['uses' => 'UpgradeController@checkStudentRegister','middleware' => ['permission:upgrade-create']]);
Route::get('/dept_select/{id}', ['uses' => 'UpgradeController@deptSelect','middleware' => ['permission:upgrade-list']]);
Route::get('/major_select/{id}', ['uses' => 'UpgradeController@majorSelect','middleware' => ['permission:upgrade-list']]);

//Route Real Score
Route::group(['prefix' => 'teach_score'], function (){
    Route::get('/', [ 'as' => 'teach_score.index', 'uses' => 'TeachScoreController@index','middleware' => ['permission:real-score']]);
    Route::get('/class/{id}', [ 'as' => 'teach_score.classlist', 'uses' => 'TeachScoreController@classlist','middleware' => ['permission:real-score']]);
    Route::get('/class/{cid}/{sid}/', [ 'as' => 'teach_score.score', 'uses' => 'TeachScoreController@score','middleware' => ['permission:real-score']]);
    Route::patch('/score/update', ['as' => 'teach_score.update', 'uses' => 'TeachScoreController@update','middleware' => ['permission:real-score']]);
    Route::get('/{id}', ['as' => 'teach_score.show', 'uses' => 'TeachScoreController@show','middleware' => ['permission:real-score']]);
    // Route::post('/', [ 'as' => 'teach_score.store', 'uses' => 'TeachScoreController@store','middleware' => ['permission:real-score']]);
    // Route::get('/{id}/edit',['as' => 'teach_score.edit', 'uses' => 'TeachScoreController@edit','middleware' => ['permission:real-score']]);
    // Route::delete('/{id}',['as' => 'teach_score.destroy', 'uses' => 'TeachScoreController@destroy','middleware' => ['permission:real-score']]);

});

//Route Upgrade Score
Route::group(['prefix' => 'teach_score_upgrade'], function (){
    Route::get('/', [ 'as' => 'teach_score_upgrade.index', 'uses' => 'TeachScoreUpgradeController@index','middleware' => ['permission:upgrade-score']]);
    Route::get('/create', [ 'as' => 'teach_score_upgrade.create', 'uses' => 'TeachScoreUpgradeController@create','middleware' => ['permission:upgrade-score']]);
    Route::get('/{id}', ['as' => 'teach_score_upgrade.show', 'uses' => 'TeachScoreUpgradeController@show','middleware' => ['permission:upgrade-score']]);
    Route::post('/', [ 'as' => 'teach_score_upgrade.store', 'uses' => 'TeachScoreUpgradeController@store','middleware' => ['permission:upgrade-score']]);
    Route::get('/{id}/edit',['as' => 'teach_score_upgrade.edit', 'uses' => 'TeachScoreUpgradeController@edit','middleware' => ['permission:upgrade-score']]);
    Route::patch('/{id}',['as' => 'teach_score_upgrade.update', 'uses' => 'TeachScoreUpgradeController@update','middleware' => ['permission:upgrade-score']]);
    Route::delete('/{id}',['as' => 'teach_score_upgrade.destroy', 'uses' => 'TeachScoreUpgradeController@destroy','middleware' => ['permission:upgrade-score']]);
//Route::resource('/teach_score_upgrade', 'TeachScoreUpgradeController');
});

//Route other setting data
Route::group(['prefix' => 'setting'], function (){
    Route::get('/', 'SettingController@index');
    Route::patch('/', 'SettingController@edit');
});

//Route View at Home to List any Activity
Route::get('/manage', ['uses' => 'OtherController@manage','middleware' => ['permission:student-list|teacher-list|dept-list|major-list|subject-list|degree-list|course-list|teacher-subject-list']]);
Route::get('/report', ['uses' => 'OtherController@report','middleware' => ['permission:report-student|report-register|report-upgrade|report-grade|report-score']]);
Route::get('/score', ['uses' => 'OtherController@score','middleware' => ['permission:real-score|upgrade-score']]);

//Route Report Student
Route::get('/student-report', ['uses' => 'ReportController@studentReport','middleware' => ['permission:report-student']]);
Route::get('/student-excel', ['uses' => 'ExportExcelController@studentExport','middleware' => ['permission:report-student']]);

//Route Report Register Semester
Route::get('/register-report', ['uses' => 'ReportController@registerReport','middleware' => ['permission:report-register']]);
Route::get('/register-excel', ['uses' => 'ExportExcelController@registerExport','middleware' => ['permission:report-register']]);

//Route Report Register Upgrade
Route::get('/upgrade-report', ['uses' => 'ReportController@upgradeReport','middleware' => ['permission:report-upgrade']]);
Route::get('/upgrade-excel', ['uses' => 'ExportExcelController@upgradeExport','middleware' => ['permission:report-upgrade']]);

//Route Report Grade
Route::get('/grade-report', ['uses' => 'ReportController@gradeReport','middleware' => ['permission:report-grade']]);

//Route Report Score
Route::get('/score-report', ['uses' => 'ReportController@scoreReport','middleware' => ['permission:report-score']]);

//Route Profile
Route::get('/profile/{id}', 'OtherController@profile');
Route::patch('/edit-profile/{id}', 'OtherController@editProfile');


