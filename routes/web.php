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

Route::get('/', 'HomeController@main');

// Public academic and digital-service landing pages.
Route::get('/faculties', function () {
    $colleges = App\College::query()->where('status', 1)
        ->orderBy('colleges_type_id', 'asc')->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
    return view('site.faculties', compact('colleges'));
})->name('faculties');

Route::get('/institutes-and-centers', function () {
    return view('site.institutes-and-centers');
})->name('institutes.centers');

// Public E-Learning entry point. Keep this on the public website, not only in the student dashboard.
Route::get('/e-learning', function () {
    return redirect()->away('https://me.classera.com/');
})->name('elearning');

Route::get('/about', function () {
    $page = App\Page::find(4);
    if ($page) {
        return redirect('/page/4/about-university-of-zalingie');
    }
    return redirect('/');
})->name('about');

Route::get('/webmail', function () {
    return redirect()->away('mailto:info@zalingei.edu.sd');
})->name('webmail');

Route::get('/page/{id}/{slug?}', 'PageController@show');
Route::get('/associations', 'UnavailableFeatureController@show');
Route::get('/associations/{id}', 'UnavailableFeatureController@show');
Route::get('/associations/{id}/news', 'UnavailableFeatureController@show');
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
        Route::any('languages_options', ['before' => 'auth.admin', 'uses' => 'JTableControllerLanguages@languagesOptions']);
        Route::post('dropzone/upload', ['before' => 'auth.admin|admin.hasAuthToAccess:dropzone', 'uses' => 'MTCPanelDropzoneController@upload'])->name('mtCPanel.dropzone.upload');
        Route::get('dropzone/get', function(){ return json_encode([]); })->name('mtCPanel.dropzone.get');
        Route::post('pages/dropzone','MTCPanelPagesController@dropzone')->name('mtCPanel.pages.dropzone');
        Route::post('pages/dropzone/remove','MTCPanelPagesController@dropzoneRemove')->name('mtCPanel.pages.dropzone.remove');
        Route::post('pages/attachments/dropzone','MTCPanelPagesAttachmentController@dropzone')->name('mtCPanel.pages.attachments.dropzone');
        Route::post('pages/attachments/dropzone/remove','MTCPanelTestamonialsController@dropzoneRemove')->name('mtCPanel.pages.attachments.dropzone.remove');
        Route::resource('pages', 'MTCPanelPagesController', ['as' => 'mtCPanel']);
        Route::resource('pages.attachments', 'MTCPanelPagesAttachmentController', ['as' => 'mtCPanel']);
        Route::post('news/dropzone','MTCPanelNewsController@dropzone')->name('mtCPanel.news.dropzone');
        Route::post('news/dropzone/remove','MTCPanelNewsController@dropzoneRemove')->name('mtCPanel.news.dropzone.remove');
        Route::resource('news', 'MTCPanelNewsController', ['as' => 'mtCPanel']);
        Route::post('banners/dropzone','MTCPanelBannersController@dropzone')->name('mtCPanel.banners.dropzone');
        Route::post('banners/dropzone/remove','MTCPanelBannersController@dropzoneRemove')->name('mtCPanel.banners.dropzone.remove');
        Route::resource('banners', 'MTCPanelBannersController', ['as' => 'mtCPanel']);
        Route::post('slides/dropzone','MTCPanelSlidesController@dropzone')->name('mtCPanel.slides.dropzone');
        Route::post('slides/dropzone/remove','MTCPanelSlidesController@dropzoneRemove')->name('mtCPanel.slides.dropzone.remove');
        Route::resource('slides', 'MTCPanelSlidesController', ['as' => 'mtCPanel']);
        Route::post('locales/dropzone','MTCPanelLocalesController@dropzone')->name('mtCPanel.locales.dropzone');
        Route::post('locales/dropzone/remove','MTCPanelLocalesController@dropzoneRemove')->name('mtCPanel.locales.dropzone.remove');
        Route::resource('locales', 'MTCPanelLocalesController', ['as' => 'mtCPanel']);
        Route::post('colleges/dropzone','MTCPanelCollegesController@dropzone')->name('mtCPanel.colleges.dropzone');
        Route::post('colleges/dropzone/remove','MTCPanelCollegesController@dropzoneRemove')->name('mtCPanel.colleges.dropzone.remove');
        Route::resource('colleges', 'MTCPanelCollegesController', ['as' => 'mtCPanel']);
        Route::get('colleges/{id}/getDepartmentsList', 'MTCPanelCollegesController@getDepartmentsList');
        Route::post('colleges/departments/dropzone','MTCPanelCollegesDepartmentsController@dropzone')->name('mtCPanel.colleges.departments.dropzone');
        Route::post('colleges/departments/dropzone/remove','MTCPanelCollegesDepartmentsController@dropzoneRemove')->name('mtCPanel.colleges.departments.dropzone.remove');
        Route::resource('colleges.departments', 'MTCPanelCollegesDepartmentsController', ['as' => 'mtCPanel']);
        Route::post('colleges/staff/dropzone','MTCPanelCollegesStaffController@dropzone')->name('mtCPanel.colleges.staff.dropzone');
        Route::post('colleges/staff/dropzone/remove','MTCPanelCollegesStaffController@dropzoneRemove')->name('mtCPanel.colleges.staff.dropzone.remove');
        Route::resource('colleges.staff', 'MTCPanelCollegesStaffController', ['as' => 'mtCPanel']);
        Route::post('colleges/extraContents/dropzone','MTCPanelCollegesExtraContentsController@dropzone')->name('mtCPanel.colleges.extraContents.dropzone');
        Route::post('colleges/extraContents/dropzone/remove','MTCPanelCollegesExtraContentsController@dropzoneRemove')->name('mtCPanel.colleges.extraContents.dropzone.remove');
        Route::resource('colleges.extraContents', 'MTCPanelCollegesExtraContentsController', ['as' => 'mtCPanel']);
        Route::post('colleges/details/dropzone','MTCPanelCollegesDetailsController@dropzone')->name('mtCPanel.colleges.details.dropzone');
        Route::post('colleges/details/dropzone/remove','MTCPanelCollegesDetailsController@dropzoneRemove')->name('mtCPanel.colleges.details.dropzone.remove');
        Route::resource('colleges.details', 'MTCPanelCollegesDetailsController', ['as' => 'mtCPanel']);
        Route::post('colleges/news/dropzone','MTCPanelCollegesNewsController@dropzone')->name('mtCPanel.colleges.news.dropzone');
        Route::post('colleges/news/dropzone/remove','MTCPanelCollegesNewsController@dropzoneRemove')->name('mtCPanel.colleges.news.dropzone.remove');
        Route::resource('colleges.news', 'MTCPanelCollegesNewsController', ['as' => 'mtCPanel']);
        Route::post('testamonials/dropzone','MTCPanelTestamonialsController@dropzone')->name('mtCPanel.testamonials.dropzone');
        Route::post('testamonials/dropzone/remove','MTCPanelTestamonialsController@dropzoneRemove')->name('mtCPanel.testamonials.dropzone.remove');
        Route::resource('testamonials', 'MTCPanelTestamonialsController', ['as' => 'mtCPanel']);
        Route::post('services/dropzone','MTCPanelServicesController@dropzone')->name('mtCPanel.services.dropzone');
        Route::post('services/dropzone/remove','MTCPanelServicesController@dropzoneRemove')->name('mtCPanel.services.dropzone.remove');
        Route::resource('services', 'MTCPanelServicesController', ['as' => 'mtCPanel']);
        Route::post('admins/dropzone','MTCPanelAdminsController@dropzone')->name('mtCPanel.admins.dropzone');
        Route::post('admins/dropzone/remove','MTCPanelAdminsController@dropzoneRemove')->name('mtCPanel.admins.dropzone.remove');
        Route::post('admins/privs/dropzone','MTCPanelTestamonialsController@dropzone')->name('mtCPanel.admins.privs.dropzone');
        Route::post('admins/privs/dropzone/remove','MTCPanelTestamonialsController@dropzoneRemove')->name('mtCPanel.admins.privs.dropzone.remove');
        Route::resource('admins', 'MTCPanelAdminsController', ['as' => 'mtCPanel']);
        Route::resource('admins.privs', 'MTCPanelAdminsPrivsController', ['as' => 'mtCPanel']);
        Route::post('polls/dropzone','MTCPanelTestamonialsController@dropzone')->name('mtCPanel.polls.dropzone');
        Route::post('polls/dropzone/remove','MTCPanelTestamonialsController@dropzoneRemove')->name('mtCPanel.polls.dropzone.remove');
        Route::post('polls/answers/dropzone','MTCPanelTestamonialsController@dropzone')->name('mtCPanel.polls.answers.dropzone');
        Route::post('polls/answers/dropzone/remove','MTCPanelTestamonialsController@dropzoneRemove')->name('mtCPanel.polls.answers.dropzone.remove');
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
