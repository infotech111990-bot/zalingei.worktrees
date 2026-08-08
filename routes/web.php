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

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
      Session::put('locale', $locale);
    }
    return redirect()->back();
});
//-- Student Portal Routes ------------------------------------------------------------------------//
Route::get('/student-portal', 'StudentPortalController@index')->name('student.portal');
Route::get('/student-portal/register', 'StudentPortalController@registerForm')->name('student.register');
Route::post('/student-portal/register', 'StudentPortalController@register')->name('student.register.submit');
Route::get('/student-portal/results', 'StudentPortalController@results')->name('student.results');

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

Route::get('/termsOfUse', function(){
  return view('site.privacyPolicy');
});
Route::get('/privacyPolicy', function(){
  return view('site.privacyPolicy');
});


Auth::routes();
Route::get('/home', 'HomeController@index');
Route::prefix('mtCPanel')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('mtCPanel.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('mtCPanel.login.submit');

    Route::group(['middleware' => ['auth:admin']], function(){
        Route::get('/', 'AdminController@index')->name('mtCPanel.dashboard');
        Route::post('/logout', 'HomeController@logout')->name('mtCPanel.logout');

        //-- Pages Control ---------------------------------------------------------------------------//
        Route::any('languages_options', array('before' => 'auth.admin' ,'uses' => 'JTableControllerLanguages@languagesOptions'));

        //-- Dropzone Uploader -----------------------------------------------------------------------//
        Route::post('dropzone/upload', array('before' => 'auth.admin|admin.hasAuthToAccess:dropzone' ,'uses' => 'MTCPanelDropzoneController@upload'))->name('mtCPanel.dropzone.upload');
        Route::get('dropzone/get', function(){

          $a = [
            ["name" => "assaassasa",
            "size" => 1234,
            "filetype" => "image/jpeg"],
            ["name" => "assaassasa",
            "size" => 1234,
            "filetype" => "image/jpeg"],
            ["name" => "assaassasa",
            "size" => 1234,
            "filetype" => "image/jpeg"],
            ["name" => "assaassasa",
            "size" => 1234,
            "filetype" => "image/jpeg"],
          ];
          return json_encode($a);
        })->name('mtCPanel.dropzone.get');

        //-- Pages Control ---------------------------------------------------------------------------//
        Route::post('pages/dropzone','MTCPanelPagesController@dropzone')->name('mtCPanel.pages.dropzone');
        Route::post('pages/dropzone/remove','MTCPanelPagesController@dropzoneRemove')->name('mtCPanel.pages.dropzone.remove');
        Route::post('pages/attachments/dropzone','MTCPanelPagesAttachmentController@dropzone')->name('mtCPanel.pages.attachments.dropzone');
        Route::post('pages/attachments/dropzone/remove','MTCPanelTestamonialsController@dropzoneRemove')->name('mtCPanel.pages.attachments.dropzone.remove');
        Route::resource('pages', 'MTCPanelPagesController', ['as' => 'mtCPanel']);
        Route::resource('pages.attachments', 'MTCPanelPagesAttachmentController', ['as' => 'mtCPanel']);
        
        //-- News Control ---------------------------------------------------------------------------//
        Route::post('news/dropzone','MTCPanelNewsController@dropzone')->name('mtCPanel.news.dropzone');
        Route::post('news/dropzone/remove','MTCPanelNewsController@dropzoneRemove')->name('mtCPanel.news.dropzone.remove');
        Route::resource('news', 'MTCPanelNewsController', ['as' => 'mtCPanel']);

        //-- Banners Control ---------------------------------------------------------------------------//
        Route::post('banners/dropzone','MTCPanelBannersController@dropzone')->name('mtCPanel.banners.dropzone');
        Route::post('banners/dropzone/remove','MTCPanelBannersController@dropzoneRemove')->name('mtCPanel.banners.dropzone.remove');
        Route::resource('banners', 'MTCPanelBannersController', ['as' => 'mtCPanel']);

        //-- Slides Control ---------------------------------------------------------------------------//
        Route::post('slides/dropzone','MTCPanelSlidesController@dropzone')->name('mtCPanel.slides.dropzone');
        Route::post('slides/dropzone/remove','MTCPanelSlidesController@dropzoneRemove')->name('mtCPanel.slides.dropzone.remove');
        Route::resource('slides', 'MTCPanelSlidesController', ['as' => 'mtCPanel']);

        //-- Locales Control ---------------------------------------------------------------------------//
        Route::post('locales/dropzone','MTCPanelLocalesController@dropzone')->name('mtCPanel.locales.dropzone');
        Route::post('locales/dropzone/remove','MTCPanelLocalesController@dropzoneRemove')->name('mtCPanel.locales.dropzone.remove');
        Route::resource('locales', 'MTCPanelLocalesController', ['as' => 'mtCPanel']);

        //-- Colleges Control ---------------------------------------------------------------------------//
        Route::post('colleges/dropzone','MTCPanelCollegesController@dropzone')->name('mtCPanel.colleges.dropzone');
        Route::post('colleges/dropzone/remove','MTCPanelCollegesController@dropzoneRemove')->name('mtCPanel.colleges.dropzone.remove');
        Route::resource('colleges', 'MTCPanelCollegesController', ['as' => 'mtCPanel']);
        Route::get('colleges/{id}/getDepartmentsList', 'MTCPanelCollegesController@getDepartmentsList');
        
        //-- College Departments Control ---------------------------------------------------------------------------//
        Route::post('colleges/departments/dropzone','MTCPanelCollegesDepartmentsController@dropzone')->name('mtCPanel.colleges.departments.dropzone');
        Route::post('colleges/departments/dropzone/remove','MTCPanelCollegesDepartmentsController@dropzoneRemove')->name('mtCPanel.colleges.departments.dropzone.remove');
        Route::resource('colleges.departments', 'MTCPanelCollegesDepartmentsController', ['as' => 'mtCPanel']);
        
        //-- College Staff Control ---------------------------------------------------------------------------//
        Route::post('colleges/staff/dropzone','MTCPanelCollegesStaffController@dropzone')->name('mtCPanel.colleges.staff.dropzone');
        Route::post('colleges/staff/dropzone/remove','MTCPanelCollegesStaffController@dropzoneRemove')->name('mtCPanel.colleges.staff.dropzone.remove');
        Route::resource('colleges.staff', 'MTCPanelCollegesStaffController', ['as' => 'mtCPanel']);
        
        //-- College Extra Contents Control ---------------------------------------------------------------------------//
        Route::post('colleges/extraContents/dropzone','MTCPanelCollegesExtraContentsController@dropzone')->name('mtCPanel.colleges.extraContents.dropzone');
        Route::post('colleges/extraContents/dropzone/remove','MTCPanelCollegesExtraContentsController@dropzoneRemove')->name('mtCPanel.colleges.extraContents.dropzone.remove');
        Route::resource('colleges.extraContents', 'MTCPanelCollegesExtraContentsController', ['as' => 'mtCPanel']);
        
        //-- College Details Control ---------------------------------------------------------------------------//
        Route::post('colleges/details/dropzone','MTCPanelCollegesDetailsController@dropzone')->name('mtCPanel.colleges.details.dropzone');
        Route::post('colleges/details/dropzone/remove','MTCPanelCollegesDetailsController@dropzoneRemove')->name('mtCPanel.colleges.details.dropzone.remove');
        Route::resource('colleges.details', 'MTCPanelCollegesDetailsController', ['as' => 'mtCPanel']);

        //-- College News Control ---------------------------------------------------------------------------//
        Route::post('colleges/news/dropzone','MTCPanelCollegesNewsController@dropzone')->name('mtCPanel.colleges.news.dropzone');
        Route::post('colleges/news/dropzone/remove','MTCPanelCollegesNewsController@dropzoneRemove')->name('mtCPanel.colleges.news.dropzone.remove');
        Route::resource('colleges.news', 'MTCPanelCollegesNewsController', ['as' => 'mtCPanel']);
        
        //-- Testamonials Control ---------------------------------------------------------------------------//
        Route::post('testamonials/dropzone','MTCPanelTestamonialsController@dropzone')->name('mtCPanel.testamonials.dropzone');
        Route::post('testamonials/dropzone/remove','MTCPanelTestamonialsController@dropzoneRemove')->name('mtCPanel.testamonials.dropzone.remove');
        Route::resource('testamonials', 'MTCPanelTestamonialsController', ['as' => 'mtCPanel']);
        
        //-- Services Control ---------------------------------------------------------------------------//
        Route::post('services/dropzone','MTCPanelServicesController@dropzone')->name('mtCPanel.services.dropzone');
        Route::post('services/dropzone/remove','MTCPanelServicesController@dropzoneRemove')->name('mtCPanel.services.dropzone.remove');
        Route::resource('services', 'MTCPanelServicesController', ['as' => 'mtCPanel']);
        
        //-- Admins Control ---------------------------------------------------------------------------//
        Route::post('admins/dropzone','MTCPanelAdminsController@dropzone')->name('mtCPanel.admins.dropzone');
        Route::post('admins/dropzone/remove','MTCPanelAdminsController@dropzoneRemove')->name('mtCPanel.admins.dropzone.remove');
        Route::post('admins/privs/dropzone','MTCPanelTestamonialsController@dropzone')->name('mtCPanel.admins.privs.dropzone');
        Route::post('admins/privs/dropzone/remove','MTCPanelTestamonialsController@dropzoneRemove')->name('mtCPanel.admins.privs.dropzone.remove');
        Route::resource('admins', 'MTCPanelAdminsController', ['as' => 'mtCPanel']);
        Route::resource('admins.privs', 'MTCPanelAdminsPrivsController', ['as' => 'mtCPanel']);
        
        //-- Polls Control ---------------------------------------------------------------------------//
        Route::post('polls/dropzone','MTCPanelTestamonialsController@dropzone')->name('mtCPanel.polls.dropzone');
        Route::post('polls/dropzone/remove','MTCPanelTestamonialsController@dropzoneRemove')->name('mtCPanel.polls.dropzone.remove');
        Route::post('polls/answers/dropzone','MTCPanelTestamonialsController@dropzone')->name('mtCPanel.polls.answers.dropzone');
        Route::post('polls/answers/dropzone/remove','MTCPanelTestamonialsController@dropzoneRemove')->name('mtCPanel.polls.answers.dropzone.remove');
         Route::resource('polls', 'MTCPanelPollsController', ['as' => 'mtCPanel']);
         Route::resource('polls.answers', 'MTCPanelPollsAnswersController', ['as' => 'mtCPanel']);
         
         //-- Students Control ---------------------------------------------------------------------------//
         Route::resource('students', 'MTCPanelStudentsController', ['as' => 'mtCPanel']);
         Route::get('students/{id}/results', 'MTCPanelStudentsController@results')->name('mtCPanel.students.results');
         Route::post('students/{id}/results', 'MTCPanelStudentsController@addResult')->name('mtCPanel.students.addResult');
         Route::delete('students/results/{id}', 'MTCPanelStudentsController@deleteResult')->name('mtCPanel.students.deleteResult');

         Route::any('/jTable/manager/option', 'JTableControllerManagerType@getOptions');
    });

    
  });

  // College micro-sites are intentionally explicit.  The previous optional
  // catch-all rendered the home page for typos and masked genuine 404 errors.
  Route::get('{slug}/{section?}/{id?}/{deptSection?}/{cID?}', 'CollegesController@display')
    ->where('slug', '[A-Za-z0-9-]+')
    ->name('college.display');

  Route::fallback(function () {
      abort(404);
  });
