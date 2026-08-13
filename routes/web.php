<?php

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/student-portal', 'StudentPortalController@index')->name('student.portal');
Route::get('/student-portal/register', 'StudentPortalController@registerForm')->name('student.register');
Route::post('/student-portal/register', 'StudentPortalController@register')->name('student.register.submit');
Route::get('/student-portal/results', 'StudentPortalController@results')->name('student.results');
Route::get('/student-portal/dashboard', 'StudentPortalController@dashboard')->name('student.dashboard');
Route::get('/student-portal/semesters', 'StudentPortalController@semesters')->name('student.semesters');
Route::get('/student-portal/transcript', 'StudentPortalController@transcript')->name('student.transcript');

Route::get('/faculties', function () {
    $colleges = \App\College::where('status', 1)->orderBy('sort_order')->orderBy('name_ar')->get();
    return view('site.faculties', compact('colleges'));
})->name('faculties');

Route::get('/institutes-and-centers', function () {
    return view('site.institutes-and-centers');
})->name('institutes.centers');

Route::get('/', 'HomeController@main');
Route::get('/page/{id}/{slug?}', 'PageController@show');
Route::get('/associations', 'UnavailableFeatureController@show');
Route::get('/associations/{id}', 'UnavailableFeatureController@show');
Route::get('/associations/{id}/news', 'UnavailableFeatureController@show');
Route::get('/services', 'ServiceController@show');
Route::get('/services/{id}', 'ServiceController@display');
Route::get('/associations/{id}/news/{newsID}', 'UnavailableFeatureController@show');
Route::get('/associations/{id}/details/{aboutID}', 'UnavailableFeatureController@show');
Route::post('/associations/likeThis', 'UnavailableFeatureController@show');
Route::get('/managers/profile/{id}', 'UnavailableFeatureController@show');
Route::get('/managers/{id}', 'UnavailableFeatureController@show');
Route::get('/managers', 'UnavailableFeatureController@show');
Route::get('/council/{year?}', 'UnavailableFeatureController@show');
Route::get('/news', 'NewsController@show');
Route::get('/news/{newsID}', 'NewsController@display');
Route::get('/staff/{staffID}/{slug?}', 'StaffController@display')->name('staffDetails');
Route::get('/events', 'UnavailableFeatureController@show');
Route::get('/events/{eventsID}', 'UnavailableFeatureController@show');
Route::get('/polls', 'PollController@show');
Route::get('/polls/{polls}', 'PollController@display');
Route::post('/polls/voteNow', 'PollController@voteNow');
Route::get('/contactUs', 'PageController@showContactUs');
Route::get('/search/{section}', 'UnavailableFeatureController@show')->name('search');
Route::get('/termsOfUse', function(){ return view('site.privacyPolicy'); });
Route::get('/privacyPolicy', function(){ return view('site.privacyPolicy'); });

Auth::routes();
Route::get('/home', 'HomeController@index');
Route::prefix('mtCPanel')->group(function() {
    Route::get('/login', 'Auth\\AdminLoginController@showLoginForm')->name('mtCPanel.login');
    Route::post('/login', 'Auth\\AdminLoginController@login')->name('mtCPanel.login.submit');
    Route::group(['middleware' => ['auth:admin']], function(){
        Route::get('/', 'AdminController@index')->name('mtCPanel.dashboard');
        Route::post('/logout', 'HomeController@logout')->name('mtCPanel.logout');
        Route::get('academic-management', 'AcademicManagementController@index')->name('academic.management');
        Route::post('academic-management/academic-year', 'AcademicManagementController@storeAcademicYear')->name('academic.year.store');
        Route::post('academic-management/semester', 'AcademicManagementController@storeSemester')->name('academic.semester.store');
        Route::post('academic-management/course', 'AcademicManagementController@storeCourse')->name('academic.course.store');
        Route::post('academic-management/enrollment', 'AcademicManagementController@storeEnrollment')->name('academic.enrollment.store');
        Route::post('academic-management/grade', 'AcademicManagementController@storeGrade')->name('academic.grade.store');
        Route::resource('pages', 'MTCPanelPagesController', ['as' => 'mtCPanel']);
        Route::resource('pages.attachments', 'MTCPanelPagesAttachmentController', ['as' => 'mtCPanel']);
        Route::resource('news', 'MTCPanelNewsController', ['as' => 'mtCPanel']);
        Route::resource('banners', 'MTCPanelBannersController', ['as' => 'mtCPanel']);
        Route::resource('slides', 'MTCPanelSlidesController', ['as' => 'mtCPanel']);
        Route::resource('locales', 'MTCPanelLocalesController', ['as' => 'mtCPanel']);
        Route::resource('colleges', 'MTCPanelCollegesController', ['as' => 'mtCPanel']);
        Route::get('colleges/{id}/getDepartmentsList', 'MTCPanelCollegesController@getDepartmentsList');
        Route::resource('colleges.departments', 'MTCPanelCollegesDepartmentsController', ['as' => 'mtCPanel']);
        Route::resource('colleges.staff', 'MTCPanelCollegesStaffController', ['as' => 'mtCPanel']);
        Route::resource('colleges.extraContents', 'MTCPanelCollegesExtraContentsController', ['as' => 'mtCPanel']);
        Route::resource('colleges.details', 'MTCPanelCollegesDetailsController', ['as' => 'mtCPanel']);
        Route::resource('colleges.news', 'MTCPanelCollegesNewsController', ['as' => 'mtCPanel']);
        Route::resource('testamonials', 'MTCPanelTestamonialsController', ['as' => 'mtCPanel']);
        Route::resource('services', 'MTCPanelServicesController', ['as' => 'mtCPanel']);
        Route::resource('admins', 'MTCPanelAdminsController', ['as' => 'mtCPanel']);
        Route::resource('admins.privs', 'MTCPanelAdminsPrivsController', ['as' => 'mtCPanel']);
        Route::resource('polls', 'MTCPanelPollsController', ['as' => 'mtCPanel']);
        Route::resource('polls.answers', 'MTCPanelPollsAnswersController', ['as' => 'mtCPanel']);
        Route::resource('students', 'MTCPanelStudentsController', ['as' => 'mtCPanel']);
        Route::get('students/{id}/results', 'MTCPanelStudentsController@results')->name('mtCPanel.students.results');
        Route::post('students/{id}/results', 'MTCPanelStudentsController@addResult')->name('mtCPanel.students.addResult');
        Route::delete('students/results/{id}', 'MTCPanelStudentsController@deleteResult')->name('mtCPanel.students.deleteResult');
        Route::any('/jTable/manager/option', 'JTableControllerManagerType@getOptions');
    });
});

Route::get('{slug}/{section?}/{id?}/{deptSection?}/{cID?}', 'CollegesController@display')
    ->where('slug', '[A-Za-z0-9-]+')
    ->name('college.display');
Route::fallback(function () { abort(404); });
