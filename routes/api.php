<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::controller(AuthController::class)->group(function(){
    Route::post('login', 'login');
    Route::post('register', 'register');

    Route::middleware(['auth:sanctum']) ->group(function () {
        Route::get('get_all_users', 'getAllUsers');
        Route::get('get_personal', 'getPersonalDetails');
        Route::get('get_admins', 'getAdmins');
        Route::post('logout_user', 'logout');
        Route::post('delete_admin', 'deleteAdmin');
        Route::post('update_admin', 'updateAdmin');
        Route::post('update_personal', 'updatePersonalDetails');
        Route::post('update_password', 'updatePassword');
        Route::post('register_admin', 'registerAdmin');
    });

});

Route::controller(PagesController::class)->group(function(){

    Route::middleware(['auth:sanctum']) ->group(function () {
        Route::post('update_home_content', 'homePageContent');
        Route::post('update_about_content', 'aboutPageContent');
        Route::post('update_contact_content', 'contactPageContent');
        Route::post('update_involved_content', 'involvedPageContent');
        Route::post('update_fossilfreezones_content', 'fossilFreeZonesPageContent');
        Route::post('update_examples_content', 'examplesPageContent');
        Route::post('add_case_studies', 'addCaseStudies');
        Route::post('add_client_logos', 'addClientLogos');
        Route::post('add_team_member', 'addTeamMember');
        Route::post('add_thanks', 'addThanks');
        Route::post('add_slides', 'addSlides');
        Route::post('add_faqs', 'addFaqs');
        Route::get('get_all_images', 'getImagesRecord');
        Route::get('get_teams', 'getTeamsRecord');
        Route::get('get_thanks', 'getThanksRecord');
        Route::get('get_faqs', 'getFaqsRecord');
        Route::get('get_cases', 'getCasesRecord');
        Route::get('get_rules', 'getRulesRecord');
        Route::get('get_contactform_data', 'getContactData');
        Route::get('get_zonesform_data', 'getZonesData');
        Route::get('get_ctemplate', 'getCtemplate');
        Route::get('get_ztemplate', 'getZtemplate');
        Route::post('delete_slider', 'deleteSlider');
        Route::post('delete_logo', 'deleteLogo');
        Route::post('update_member', 'updateMember');
        Route::post('update_thanks', 'updateThanks');
        Route::post('update_faqs', 'updateFaqs');
        Route::post('update_cases', 'updateCases');
        Route::post('update_rules', 'updateRules');
        Route::post('delete_member', 'deleteMember');
        Route::post('delete_thanks', 'deleteThanks');
        Route::post('delete_faqs', 'deleteFaqs');
        Route::post('delete_cases', 'deleteCases');
        Route::post('delete_rules', 'deleteRules');
        Route::post('delete_cform', 'deleteCForm');
        Route::post('delete_zform', 'deleteZForm');
        Route::post('add_rules', 'addRules');
        Route::post('update_footer', 'updateFooter');
        Route::post('update_ctemplate', 'updateCtemplate');
        Route::post('update_ztemplate', 'updateZtemplate');
        
    });
});

Route::controller(PagesController::class)->group(function(){
    Route::get('get_home_data', 'getHomePageData');
    Route::get('get_contact_data', 'getContactPageData');
    Route::get('get_about_data', 'getAboutPageData');
    Route::get('get_examples_data', 'getExamplesPageData');
    Route::get('get_involved_data', 'getInvolvedPageData');
    Route::get('get_fossilfreezones_data', 'getFossilFreeZonesPageData');
    Route::post('contact_form', 'submitContactForm');
    Route::post('zones_form', 'submitZonesForm');
    Route::post('download_file', 'downloadFile');
    Route::get('get_footer_data', 'getFooterData');
    Route::post('download_file_new', 'downloadFileNew');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
