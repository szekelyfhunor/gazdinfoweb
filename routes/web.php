<?php


//use App\Http\Controllers\Admin\ProgramController;

use App\Http\Controllers\Admin\ApplicantsForThesesController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\CompetitionController;
use App\Http\Controllers\Admin\DiplomaThesisController;
use App\Http\Controllers\Admin\ItKlubController;
use App\Http\Controllers\Admin\NewController;
use App\Http\Controllers\Admin\PartnerController;

use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TypeOfParticipationController;

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Frontend\FrontendClassController;
use App\Http\Controllers\Frontend\FrontendCompetitionController;
use App\Http\Controllers\Frontend\FrontendDiplomaThesisController;
use App\Http\Controllers\Frontend\FrontendHomePageController;
use App\Http\Controllers\Frontend\FrontendItKlubController;
use App\Http\Controllers\Frontend\FrontendNewsController;
use App\Http\Controllers\Frontend\FrontendStudentController;
use App\Http\Controllers\FrontendApplicantsController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

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


Route::get('/livewire', function () {
    return view('livewiretest');
});

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/admin', [HomeController::class, 'index'])->name('admin');

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google-auth');

Route::get('/auth/google/call-back', [GoogleController::class, 'callback']);

//----------------------------------------------PROGRAMS-------------------------------------------------------------------
Route::group([/*'middleware' => 'is_admin',*/ 'prefix' => 'admin/programs'], function () {

    Route::get('', [ProgramController::class, 'index'])->name('dashboard.programs.index');

    Route::get('/create', [ProgramController::class, 'create'])->name('dashboard.programs.create');
    Route::post('/store', [ProgramController::class, 'store'])->name('dashboard.programs.store');

    Route::get('/edit/{program}', [ProgramController::class, 'edit'])->name('dashboard.programs.edit');
    Route::post('/update/{program}', [ProgramController::class, 'update'])->name('dashboard.programs.update');

    Route::delete('/delete/{program}',[ProgramController::class, 'delete'])->name('dashboard.programs.delete');

});
//-------------------------------------------------------------------------------------------------------------------------


//----------------------------------------------CLASSES-------------------------------------------------------------------
Route::group([/*'middleware' => 'is_admin',*/ 'prefix' => 'admin/classes'], function () {

    Route::get('', [ClassController::class, 'index'])->name('dashboard.classes.index');

    Route::get('/create', [ClassController::class, 'create'])->name('dashboard.classes.create');
    Route::post('/store', [ClassController::class, 'store'])->name('dashboard.classes.store');

    Route::get('/edit/{class}', [ClassController::class, 'edit'])->name('dashboard.classes.edit');
    Route::post('/update/{class}', [ClassController::class, 'update'])->name('dashboard.classes.update');

    Route::delete('/delete/{class}',[ClassController::class, 'delete'])->name('dashboard.class.delete');
});

//-------------------------------------------------------------------------------------------------------------------------


//----------------------------------------------ITKLUB-------------------------------------------------------------------

Route::group([/*'middleware' => 'is_admin',*/ 'prefix' => 'admin/itKlub'], function () {
    Route::get('', [ItKlubController::class, 'index'])->name('dashboard.itklub.index');


    Route::get('/create', [ItKlubController::class, 'create'])->name('dashboard.itklub.create');
    Route::post('/store', [ItKlubController::class, 'store'])->name('dashboard.itklub.store');

    Route::get('/edit/{itklub}', [ItKlubController::class, 'edit'])->name('dashboard.itklub.edit');
    Route::post('/update/{itklub}', [ItKlubController::class, 'update'])->name('dashboard.itklub.update');


    Route::delete('/delete/{itklub}',[ItKlubController::class, 'delete'])->name('dashboard.itklub.delete');

});

//-------------------------------------------------------------------------------------------------------------------------


//-----------------------------------------------NEWS-------------------------------------------------------------------


Route::group([/*'middleware' => 'admin_or_teacher',*/ 'prefix' => 'admin/news'], function () {
    Route::get('', [NewController::class, 'index'])->name('dashboard.news.index');

    Route::get('/create', [NewController::class, 'create'])->name('dashboard.news.create');
    Route::post('/store', [NewController::class, 'store'])->name('dashboard.news.store');

    Route::get('/edit/{new}', [NewController::class, 'edit'])->name('dashboard.news.edit');
    Route::post('/update/{new}', [NewController::class, 'update'])->name('dashboard.news.update');


    Route::delete('/delete/{new}',[NewController::class, 'delete'])->name('dashboard.news.delete');
});

//-------------------------------------------------------------------------------------------------------------------------


//-------------------------------------------------USERS-------------------------------------------------------------------

Route::group([/*'middleware' => 'is_admin',*/ 'prefix' => 'admin/users'], function () {
    Route::get('', [UserController::class, 'index'])->name('dashboard.users.index');

    Route::get('/create', [UserController::class, 'create'])->name('dashboard.users.create');
    Route::post('/store', [UserController::class, 'store'])->name('dashboard.users.store');

    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('dashboard.users.edit');
    Route::post('/update/{user}', [UserController::class, 'update'])->name('dashboard.users.update');

    Route::delete('/delete/{user}',[UserController::class, 'delete'])->name('dashboard.users.delete');

    Route::post('import', [UserController::class, 'import'])->name('import');
});

/*Change Super Admin password*/
Route::group(['middleware' => 'is_super_admin', 'prefix' => 'admin/changepassword'], function () {
    Route::get('/editpwd/{user}', [ChangePasswordController::class, 'edit'])->name('dashboard.editpwd.edit');
    Route::post('/update/{user}', [ChangePasswordController::class, 'update'])->name('dashboard.editpwd.update');
});

//-------------------------------------------------------------------------------------------------------------------------


//------------------------------------------COMPETITIONS-------------------------------------------------------------------
Route::group([/*'middleware' => 'admin_or_teacher',*/ 'prefix' => '/admin/competitions'], function () {

    /*COMPETITIONS*/
    Route::get('', [CompetitionController::class, 'index'])->name('dashboard.competitions.index');

    Route::get('/create', [CompetitionController::class, 'create'])->name('dashboard.competitions.create');
    Route::post('/store', [CompetitionController::class, 'store'])->name('dashboard.competitions.store');

    Route::get('/edit/{competition}', [CompetitionController::class, 'edit'])->name('dashboard.competitions.edit');
    Route::post('/update/{competition}', [CompetitionController::class, 'update'])->name('dashboard.competitions.update');

    Route::delete('/delete/{competition}',[CompetitionController::class, 'delete'])->name('dashboard.competitions.delete');
});


//-------------------------------------------------------------------------------------------------------------------------

//------------------------------------------DIPLOMA THESES-------------------------------------------------------------------

/*DIPLOMA THESES*/
Route::group([/*'middleware' => 'admin_or_teacher',*/ 'prefix' => 'admin/diplomatheses'], function () {
    Route::get('', [DiplomaThesisController::class, 'index'])->name('dashboard.diplomatheses.index');

    Route::get('/create', [DiplomaThesisController::class, 'create'])->name('dashboard.diplomatheses.create');
    Route::post('/store', [DiplomaThesisController::class, 'store'])->name('dashboard.diplomatheses.store');

    Route::get('/edit/{diplomathese}', [DiplomaThesisController::class, 'edit'])->name('dashboard.diplomatheses.edit');
    Route::post('/update/{diplomathese}', [DiplomaThesisController::class, 'update'])->name('dashboard.diplomatheses.update');

    Route::get('/editAcceptedThesis/{diplomathese}', [DiplomaThesisController::class, 'editAcceptedThesis'])->name('dashboard.diplomatheses.editAccepted');

    Route::delete('/delete/{diplomathese}', [DiplomaThesisController::class, 'delete'])->name('dashboard.diplomatheses.delete');
    Route::post('/publish/{diplomathese}', [DiplomaThesisController::class, 'publish'])->name('dashboard.diplomatheses.publish');

    Route::get('/applicants', [ApplicantsForThesesController::class, 'index'])->name('dashboard.diplomatheses.applicants');
    Route::post('/applicants/accept/{id}', [ApplicantsForThesesController::class, 'accept'])->name('accept');
    Route::post('/applicants/reject/{id}', [ApplicantsForThesesController::class, 'reject'])->name('reject');
});


//-------------------------------------------------------------------------------------------------------------------------

//------------------------------------------TYPE OF PARTICIPATIONS-------------------------------------------------------------------

Route::group([/*'middleware' => 'admin_or_teacher',*/ 'prefix' => 'admin/typeofparticipations'], function () {
    Route::get('', [TypeOfParticipationController::class, 'index'])->name('dashboard.typeofparticipations.index');

    Route::get('/create', [TypeOfParticipationController::class, 'create'])->name('dashboard.typeofparticipations.create');
    Route::post('/store', [TypeOfParticipationController::class, 'store'])->name('dashboard.typeofparticipations.store');

    Route::get('/edit/{typeofparticipation}', [TypeOfParticipationController::class, 'edit'])->name('dashboard.typeofparticipations.edit');
    Route::post('/update/{typeofparticipation}', [TypeOfParticipationController::class, 'update'])->name('dashboard.typeofparticipations.update');

    Route::delete('/delete/{typeofparticipation}', [TypeOfParticipationController::class, 'delete'])->name('dashboard.typeofparticipations.delete');


});

//-------------------------------------------------------------------------------------------------------------------------

//-------------------------------------------------TOPICS-------------------------------------------------------------------

Route::group([/*'middleware' => 'admin_or_teacher',*/ 'prefix' => 'admin/topics'], function () {

    Route::get('', [TopicController::class, 'index'])->name('dashboard.topics.index');

    Route::get('/create', [TopicController::class, 'create'])->name('dashboard.topics.create');
    Route::post('/store', [TopicController::class, 'store'])->name('dashboard.topics.store');

    Route::get('/edit/{topic}', [TopicController::class, 'edit'])->name('dashboard.topics.edit');
    Route::post('/update/{topic}', [TopicController::class, 'update'])->name('dashboard.topics.update');

    Route::delete('/delete/{topic}', [TopicController::class, 'delete'])->name('dashboard.topics.delete');
});
//-------------------------------------------------------------------------------------------------------------------------

//-------------------------------------------------Reviews-------------------------------------------------------------------

Route::group([/*'middleware' => 'is_admin',*/ 'prefix' => 'admin/reviews'], function () {

    Route::get('', [ReviewController::class, 'index'])->name('dashboard.reviews.index');

    Route::get('/create', [ReviewController::class, 'create'])->name('dashboard.reviews.create');
    Route::post('/store', [ReviewController::class, 'store'])->name('dashboard.reviews.store');

    Route::get('/edit/{review}', [ReviewController::class, 'edit'])->name('dashboard.reviews.edit');
    Route::post('/update/{review}', [ReviewController::class, 'update'])->name('dashboard.reviews.update');

    Route::delete('/delete/{review}', [ReviewController::class, 'delete'])->name('dashboard.reviews.delete');
});

//-------------------------------------------------------------------------------------------------------------------------

//-------------------------------------------------Partners-------------------------------------------------------------------

Route::group([/*'middleware' => 'is_admin',*/ 'prefix' => 'admin/partners'], function () {

    Route::get('', [PartnerController::class, 'index'])->name('dashboard.partners.index');

    Route::get('/create', [PartnerController::class, 'create'])->name('dashboard.partners.create');
    Route::post('/store', [PartnerController::class, 'store'])->name('dashboard.partners.store');

    Route::get('/edit/{partner}', [PartnerController::class, 'edit'])->name('dashboard.partners.edit');
    Route::post('/update/{partner}', [PartnerController::class, 'update'])->name('dashboard.partners.update');

    Route::delete('/delete/{partner}', [PartnerController::class, 'delete'])->name('dashboard.partners.delete');
});

//-------------------------------------------------------------------------------------------------------------------------

//-------------------------------------------------Partners-------------------------------------------------------------------

Route::group([/*'middleware' => 'is_admin',*/ 'prefix' => 'admin/subjects'], function () {

    Route::get('', [SubjectController::class, 'index'])->name('dashboard.subjects.index');

    Route::get('/create', [SubjectController::class, 'create'])->name('dashboard.subjects.create');
    Route::post('/store', [SubjectController::class, 'store'])->name('dashboard.subjects.store');

    Route::get('/edit/{subject}', [SubjectController::class, 'edit'])->name('dashboard.subjects.edit');
    Route::post('/update/{subject}', [SubjectController::class, 'update'])->name('dashboard.subjects.update');

    Route::delete('/delete/{subject}', [SubjectController::class, 'delete'])->name('dashboard.subjects.delete');
});

//-------------------------------------------------------------------------------------------------------------------------


//-------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------FRONTEND--------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------


Route::group(['prefix' => '/'], function () {

    Route::get('', [FrontendHomePageController::class, 'index'])->name('frontend.homepage.index');

});



Route::group(['prefix' => 'news'], function () {

    Route::get('', [FrontendNewsController::class, 'index'])->name('frontend.news.index');
    Route::get('/{new}', [FrontendNewsController::class, 'show'])->name('frontend.news.show');

});


Route::group(['prefix' => 'diplomatheses'], function () {

    Route::get('', [FrontendDiplomaThesisController::class, 'index'])->name('frontend.diplomatheses.index');

});

Route::group(['prefix' => 'applicants'], function () {

    Route::get('', [\App\Http\Controllers\Frontend\FrontendApplicantsController::class, 'index'])->name('frontend.applicants.index');
    Route::get('/{thesis}', [\App\Http\Controllers\Frontend\FrontendApplicantsController::class, 'apply'])->name('frontend.applicants.apply');
    Route::post('/store', [\App\Http\Controllers\Frontend\FrontendApplicantsController::class, 'store'])->name('frontend.applicants.store');

});

Route::group(['prefix' => 'competitions'], function () {

    Route::get('', [FrontendCompetitionController::class, 'index'])->name('frontend.competitions.index');

});

Route::group(['prefix' => 'itklub'], function () {

    Route::get('', [FrontendItKlubController::class, 'index'])->name('frontend.itklub.index');

});


Route::group(['prefix' => 'classes'], function () {

    Route::get('', [FrontendClassController::class, 'index'])->name('frontend.classes.index');

});

Route::group(['prefix' => 'students'], function () {

    Route::get('', [FrontendStudentController::class, 'index'])->name('frontend.students.index');

});
