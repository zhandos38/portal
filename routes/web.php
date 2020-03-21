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
    return redirect('/home');
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

//Auth::routes(['verify' => true]);
Route::get('login', 'LoginController@index')->name('login');
Route::post('auth', 'LoginController@auth')->name('auth');
Route::get('logout', 'LoginController@logout')->name('logout');

Route::group(['middleware' => 'security'], function (){
    Route::get('/home', 'HomeController@index')->name('home');
    //MODERATOR
    Route::group(['middleware' => 'moderator'], function(){
        Route::resource('shedules', 'SheduleController');
        Route::resource('quizzes', 'QuizController');
        Route::resource('questions', 'QuestionController');
        Route::get('questions/add-question/{id}', 'QuestionController@addQuestion')->name('addQuestion');
        Route::post('questions/import-excel', 'QuestionController@importExcelToDB');
        Route::post("examSchedules/getData",'ExamScheduleController@getData');
        Route::resource('examSchedules', 'ExamScheduleController');

        //ADMINISTRATOR
        Route::group(['middleware' => 'administrator'], function(){
            //expel Student
            Route::get("expel/{id}","UserController@expel")->name("users.expel");
            Route::get("expelled","UserController@expelled")->name("users.expelled");
            Route::get("active-students","UserController@active")->name("users.active");
            //Moderator, teacher, students
            Route::get("moderators","UserController@moderator")->name("users.moderator");
            Route::get("teachers","UserController@teacher")->name("users.teacher");
            Route::get("students","UserController@student")->name("users.students");
            //Subject Lists
            Route::resource('subjectLists', 'SubjectListController');
            //End of Subject Lists
            //Switch Test
            Route::post("/switch-test","ExamScheduleController@switch");
            //active Exam Shedule
            Route::get("active-schedules","ExamScheduleController@active")->name("examSchedules.active");
            Route::get("disactive-schedules","ExamScheduleController@disactive")->name("examSchedules.disactive");

            Route::resource('users', 'UserController');
            Route::get('users-info/{id}', 'UserInfoController@create')->name('usersId');
            Route::resource('departments', 'DepartmentController');
            Route::resource('groups', 'GroupController');
            Route::resource('languages', 'LanguageController');
            Route::resource('userInfos', 'UserInfoController');
            Route::resource('lessonTypes', 'LessonTypeController');
            Route::resource('subjects', 'SubjectController');

            //FOR_PRINT
            Route::get('print', 'PrintController@index')->name('print');
            Route::post('transcript', 'PrintController@search');
            Route::post('list-students', 'PrintController@lists');
            Route::post('list-assign', 'PrintController@assign');

            //Search
            Route::get("search","SearchController@search")->name("search");
            Route::post("search-result","SearchController@result")->name("search.result");
            Route::get("search-schedule","SearchController@schedule")->name("search.schedule");
            Route::post("search-shedule-result","SearchController@scheduleResult")->name("search.scheduleResult");
            //SUPERADMIN
            Route::group(['middleware' => 'superadmin'], function(){
                //superadmin,administrator,teacher,students
                Route::get("superAdmins","UserController@superAdmin")->name("users.superAdmin");
                Route::get("administrators","UserController@administrator")->name("users.administrator");
                Route::resource('faculties', 'FacultyController');
                Route::resource('semesters', 'SemesterController');
                Route::resource('years', 'YearController');
                Route::post("current-semesters","SemesterController@change");
                Route::post('step-semester', 'SemesterController@step')->name('step-semester');
                Route::resource('nationalities', 'NationalityController');
                Route::resource('countries', 'CountryController');
            });
        });
    });

//TEACHER
    Route::group(['middleware' => 'teacher'], function(){
        Route::get('/teacher-info', 'Teacher\TeacherController@index')->name('teacherInfo');
        //schedule
        Route::get("/teacher-schedule","Teacher\TeacherController@schedule")->name("teacher.schedule");
        Route::get("/teacher-examschedule","Teacher\TeacherController@examschedule")->name("teacher.examschedule");

        //library

        Route::resource('libraries', 'LibraryController');

        //material
        Route::post("materials/getData",'MaterialController@getData');
        Route::resource('materials', 'MaterialController');

        //Envelope
        Route::get('/teacher-envelope', 'Teacher\TeacherController@envelope')->name('teacherEnvelope');
        Route::get('/teacher-envelope-get-students/{id}', 'Teacher\TeacherController@envelopeGetStudents')->name('teacherEnvelopeGetStudents');
        Route::post('/teacher-envelope-send', 'Teacher\TeacherController@envelopeSendStudents')->name('teacherEnvelopeSendStudents');
        Route::get('/teacher-envelope-red/{id}', 'Teacher\TeacherController@envelopeRed')->name('teacherEnvelopeRed');
        Route::get('/teacher-envelope-send/{id}', 'Teacher\TeacherController@envelopeSend')->name('teacherEnvelopeSend');

        Route::resource('assignments', 'AssignmentController');
        Route::post('assignments/get-data', 'AssignmentController@getData');
    });

//STUDENT
    Route::group(['middleware' => 'student'], function(){
        Route::get('/student-info', 'Student\StudentController@info')->name('studentInfo');

        Route::get("/student-schedule","Student\StudentController@schedule")->name("student.schedule");
        Route::get("/student-examschedule","Student\StudentController@examschedule")->name("student.examschedule");

        //student-subjects
        Route::get("/student-subject","Student\StudentController@subject")->name("student.subject");
        //student-assignment
        Route::get("/student-assignment","Student\StudentController@assignment")->name("student.assignment");
        Route::get("/student-current-assignment","Student\StudentController@currentassignment")->name("student.current-assignment");


        //schedule
        Route::get("/student-schedule","Student\StudentController@schedule")->name("student.schedule");
        Route::get("/student-examschedule","Student\StudentController@examschedule")->name("student.examschedule");
        //material
        Route::get("/student-material","Student\StudentController@material")->name("student.material");


        //Envelope
        Route::get('/student-envelope', 'Student\StudentController@envelope')->name('studentEnvelope');
        Route::get('/student-envelope-get-teachers/{id}', 'Student\StudentController@envelopeGetTeachers')->name('studentEnvelopeGetTeachers');
        Route::post('/student-envelope-send', 'Student\StudentController@envelopeSendTeacher')->name('studentEnvelopeSendTeacher');
        Route::get('/student-envelope-red/{id}', 'Student\StudentController@envelopeRed')->name('studentEnvelopeRed');
        Route::get('/student-envelope-send/{id}', 'Student\StudentController@envelopeSend')->name('studentEnvelopeSend');

        //Pass exam
        Route::get("/student-exam",'Student\StudentController@exam')->name("student.exam");
        Route::get("/student-exam{id}/{examid}",'Student\StudentController@passexam')->name("student.exampass");
        Route::post("/student-check","Student\StudentController@check")->name("student.check");
    });

    Route::get("libraries-download/{id}","LibraryController@download")->name("libraries.download");
});
