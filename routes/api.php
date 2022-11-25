<?php
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\User;
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
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'api','prefix' => 'auth'], function($router) {
    Route::post('logout', [AuthController::class, 'logout']);
    
    });
    
Route::get('me', [AuthController::class, 'me']);
//User
Route::post('/user', [App\Http\Controllers\UserController::class, 'create_User']);
Route::delete('/user/{User}', [App\Http\Controllers\UserController::class, 'delete_User']);
Route::put('/user/{User}', [App\Http\Controllers\UserController::class, 'update_User']);
Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'read_User']);
Route::get('/user', [App\Http\Controllers\UserController::class, 'show_Users']);
//User_role
Route::post('/user_role', [App\Http\Controllers\UserRole::class, 'create_User_role']);
Route::delete('/user_role/{User_role}', [App\Http\Controllers\UserRole::class, 'delete_User_role']);
Route::put('/user_role/{User_role}', [App\Http\Controllers\UserRole::class, 'update_User_role']);
Route::get('/user_role/{id}', [App\Http\Controllers\UserRole::class, 'read_User_role']);
Route::get('/user_role', [App\Http\Controllers\UserRole::class, 'show_User_roles']);
//Role
Route::post('/role', [App\Http\Controllers\RoleController::class, 'create_Role']);
Route::delete('/role/{Role}', [App\Http\Controllers\RoleController::class, 'delete_Role']);
Route::put('/role/{Role}', [App\Http\Controllers\RoleController::class, 'update_Role']);
Route::get('/role/{id}', [App\Http\Controllers\RoleController::class, 'read_Role']);
Route::get('/role', [App\Http\Controllers\RoleController::class, 'show_Roles']);
//institution
Route::post('/institution', [App\Http\Controllers\InstitutionController::class, 'create_institution']);
Route::delete('/institution/{Institution}', [App\Http\Controllers\InstitutionController::class, 'delete_institution']);
Route::put('/institution/{Institution}', [App\Http\Controllers\InstitutionController::class, 'update_institution']);
Route::get('/institution/{id}', [App\Http\Controllers\InstitutionController::class, 'read_institution']);
Route::get('/institution', [App\Http\Controllers\InstitutionController::class, 'show_institutions']);
//institution_formation
Route::post('/institution_formation', [App\Http\Controllers\InstitutionFormation::class, 'create_institution_formation']);
Route::delete('/institution_formation/{Institution_formation}', [App\Http\Controllers\InstitutionFormation::class, 'delete_institution_formation']);
Route::put('/institution_formation/{Institution_formation}', [App\Http\Controllers\InstitutionFormation::class, 'update_institution_formation']);
Route::get('/institution_formation/{id}', [App\Http\Controllers\InstitutionFormation::class, 'read_institution_formation']);
Route::get('/institution_formation', [App\Http\Controllers\InstitutionFormation::class, 'show_institution_formations']);
//formation
Route::post('/formation', [App\Http\Controllers\FormationController::class, 'create_formation']);
Route::delete('/formation/{Formation}', [App\Http\Controllers\FormationController::class, 'delete_formation']);
Route::put('/formation/{Formation}', [App\Http\Controllers\FormationController::class, 'update_formation']);
Route::get('/formation/{id}', [App\Http\Controllers\FormationController::class, 'read_formation']);
Route::get('/formation', [App\Http\Controllers\FormationController::class, 'show_formations']);
//formation degree
Route::post('/formation_degree', [App\Http\Controllers\FormationDegree::class, 'create_formation_degree']);
Route::delete('/formation_degree/{Formation_degree}', [App\Http\Controllers\FormationDegree::class, 'delete_formation_degree']);
Route::put('/formation_degree/{Formation_degree}', [App\Http\Controllers\FormationDegree::class, 'update_formation_degree']);
Route::get('/formation_degree/{id}', [App\Http\Controllers\FormationDegree::class, 'read_formation_degree']);
Route::get('/formation_degree', [App\Http\Controllers\FormationDegree::class, 'show_formation_degrees']);
//institution type 
Route::post('/i_type', [App\Http\Controllers\InstitutionType::class, 'create_itype']);
Route::delete('/i_type/{Institution_type}', [App\Http\Controllers\InstitutionType::class, 'delete_itype']);
Route::put('/i_type/{Institution_type}', [App\Http\Controllers\InstitutionType::class, 'update_itype']);
Route::get('/i_type/{id}', [App\Http\Controllers\InstitutionType::class, 'read_itype']);
Route::get('/i_type', [App\Http\Controllers\InstitutionType::class, 'show_itypes']);
//degree
Route::post('/degree', [App\Http\Controllers\DegreeController::class, 'create_degree']);
Route::delete('/degree/{Degree}', [App\Http\Controllers\DegreeController::class, 'delete_degree']);
Route::put('/degree/{Degree}', [App\Http\Controllers\DegreeController::class, 'update_degree']);
Route::get('/degree/{id}', [App\Http\Controllers\DegreeController::class, 'read_degree']);
Route::get('/degree', [App\Http\Controllers\DegreeController::class, 'show_degrees']);
//job
Route::post('/job', [App\Http\Controllers\JobController::class, 'create_job']);
Route::delete('/job/{Job}', [App\Http\Controllers\JobController::class, 'delete_job']);
Route::put('/job/{Job}', [App\Http\Controllers\JobController::class, 'update_job']);
Route::get('/job/{id}', [App\Http\Controllers\JobController::class, 'read_job']);
Route::get('/job', [App\Http\Controllers\JobController::class, 'show_jobs']);
//family job
Route::post('/family_job', [App\Http\Controllers\FamilyJob::class, 'create_family_job']);
Route::delete('/family_job/{family_job}', [App\Http\Controllers\FamilyJob::class, 'delete_family_job']);
Route::put('/family_job/{family_job}', [App\Http\Controllers\FamilyJob::class, 'update_family_job']);
Route::get('/family_job/{id}', [App\Http\Controllers\FamilyJob::class, 'read_family_job']);
Route::get('/family_job', [App\Http\Controllers\FamilyJob::class, 'show_family_jobs']);
//job_degree
Route::post('/job_degree', [App\Http\Controllers\JobDegree::class, 'create_job_degree']);
Route::delete('/job_degree/{Job_degree}', [App\Http\Controllers\JobDegree::class, 'delete_job_degree']);
Route::put('/job_degree/{Job_degree}', [App\Http\Controllers\JobDegree::class, 'update_job_degree']);
Route::get('/job_degree/{id}', [App\Http\Controllers\JobDegree::class, 'read_job_degree']);
Route::get('/job_degree', [App\Http\Controllers\JobDegree::class, 'show_job_degrees']);
//school
Route::post('/school', [App\Http\Controllers\SchoolController::class, 'create_school']);
Route::delete('/school/{School}', [App\Http\Controllers\SchoolController::class, 'delete_school']);
Route::put('/school/{School}', [App\Http\Controllers\SchoolController::class, 'update_school']);
Route::get('/school/{id}', [App\Http\Controllers\SchoolController::class, 'read_school']);
Route::get('/school', [App\Http\Controllers\SchoolController::class, 'show_schools']);
//school level
Route::post('/school_level', [App\Http\Controllers\SchoolController::class, 'create_school_level']);
Route::get('/school_level/{id}', [App\Http\Controllers\SchoolController::class, 'read_school_level']);
Route::put('/school_level/{School_level}', [App\Http\Controllers\SchoolController::class, 'update_school_level']);
Route::delete('/school_level/{School_level}', [App\Http\Controllers\SchoolController::class, 'delete_school_level']);
Route::get('/school_level', [App\Http\Controllers\SchoolController::class, 'show_school_levels']);
//academy
Route::get('/academy', [App\Http\Controllers\SchoolController::class, 'show_academies']);
Route::get('/academy/{id}', [App\Http\Controllers\SchoolController::class, 'read_academy']);
Route::post('/academy', [App\Http\Controllers\SchoolController::class, 'create_academy']);
Route::put('/academy/{Academy}', [App\Http\Controllers\SchoolController::class, 'update_academy']);
Route::delete('/academy/{Academy}', [App\Http\Controllers\SchoolController::class, 'delete_academy']);

//student
Route::post('/student', [App\Http\Controllers\StudentController::class, 'store']);
Route::get('/student', [App\Http\Controllers\StudentController::class, 'index']);
Route::put('/student/{student}', [App\Http\Controllers\StudentController::class, 'update']);
Route::delete('/student/{student}', [App\Http\Controllers\StudentController::class, 'destroy']);
Route::put('/search/{data}', [App\Http\Controllers\StudentController::class, 'search']);
//language
Route::post('/language', [App\Http\Controllers\LanguageController::class, 'index']);
Route::get('/language', [App\Http\Controllers\LanguageController::class, 'showLanguage']);
Route::put('/language/{language}', [App\Http\Controllers\LanguageController::class, 'updateLanguage']);
Route::delete('/language/{language}', [App\Http\Controllers\LanguageController::class, 'deleteLanguage']);
//category
Route::post('/category', [App\Http\Controllers\CategoryController::class, 'index']);
Route::put('/category/{category}', [App\Http\Controllers\CategoryController::class, 'updateCategory']);
Route::delete('/category/{category}', [App\Http\Controllers\CategoryController::class, 'deleteCategory']);
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'showCategory']);
//question
Route::get('/question', [App\Http\Controllers\QuestionController::class, 'showQuestion']);
Route::post('/question', [App\Http\Controllers\QuestionController::class, 'index']);
Route::put('/question/{question}', [App\Http\Controllers\QuestionController::class, 'updateQuestion']);
Route::delete('/question/{question}', [App\Http\Controllers\QuestionController::class, 'deleteQuestion']);
//answer
Route::post('/answer', [App\Http\Controllers\AnswerController::class, 'index']);
Route::get('/answer', [App\Http\Controllers\AnswerController::class, 'showAnswer']);
Route::put('/answer/{answer}', [App\Http\Controllers\AnswerController::class, 'updateAnswer']);
Route::delete('/answer/{answer}', [App\Http\Controllers\AnswerController::class, 'deleteAnswer']);
//test
Route::post('/test', [App\Http\Controllers\TestController::class, 'index']);
Route::get('/test', [App\Http\Controllers\TestController::class, 'showTest']);
Route::put('/test/{test}', [App\Http\Controllers\TestController::class, 'updateTest']);
Route::delete('/test/{test}', [App\Http\Controllers\TestController::class, 'deleteTest']);
//weight
Route::post('/weight', [App\Http\Controllers\WeightController::class, 'index']);
Route::get('/weight', [App\Http\Controllers\WeightController::class, 'showWeight']);
Route::put('/weight/{weight}', [App\Http\Controllers\WeightController::class, 'updateWeight']);
Route::delete('/weight/{weight}', [App\Http\Controllers\WeightController::class, 'deleteWeight']);
//coach
Route::post('/coach', [App\Http\Controllers\CoachController::class, 'index']);
Route::get('/coach', [App\Http\Controllers\CoachController::class, 'showCoach']);
Route::put('/coach/{coach}', [App\Http\Controllers\CoachController::class, 'updateCoach']);
Route::delete('/coach/{coach}', [App\Http\Controllers\CoachController::class, 'deleteCoach']);
//categoryScore
Route::post('/category_score', [App\Http\Controllers\CategoryScoreController::class, 'index']);
Route::get('/category_score', [App\Http\Controllers\CategoryScoreController::class, 'showCategoryScore']);
Route::put('/category_score/{category_score}', [App\Http\Controllers\CategoryScoreController::class, 'updateCategoryScore']);
Route::delete('/category_score/{category_score}', [App\Http\Controllers\CategoryScoreController::class, 'deleteCategoryScore']);
//studentCoach
Route::post('/student_coach', [App\Http\Controllers\StudentCoachController::class, 'index']);
Route::get('/student_coach', [App\Http\Controllers\StudentCoachController::class, 'showStudentCoach']);
Route::put('/student_coach/{studentCoach}', [App\Http\Controllers\StudentCoachController::class, 'updateStudentCoach']);
Route::delete('/student_coach/{studentCoach}', [App\Http\Controllers\StudentCoachController::class, 'deleteStudentCoach']);
//studentSubscriptionAt
Route::post('/student_subscription_at', [App\Http\Controllers\StudentSubscriptionAtController::class, 'index']);
Route::get('/student_subscription_at', [App\Http\Controllers\StudentSubscriptionAtController::class, 'show']);
Route::put('/student_subscription_at/{student_subscription_at}', [App\Http\Controllers\StudentSubscriptionAtController::class, 'update']);
Route::delete('/student_subscription_at/{student_subscription_at}', [App\Http\Controllers\StudentSubscriptionAtController::class, 'delete']);
//subscription
Route::post('/subscription', [App\Http\Controllers\SubscriptionController::class, 'index']);
Route::get('/subscription', [App\Http\Controllers\SubscriptionController::class, 'showSubscription']);
Route::put('/subscription/{subscription}', [App\Http\Controllers\SubscriptionController::class, 'updatesubscription']);
Route::delete('/subscription/{subscription}', [App\Http\Controllers\SubscriptionController::class, 'deleteSubscription']);
//categoryJob
Route::post('/category_job', [App\Http\Controllers\CategoryScoreController::class, 'index']);
Route::get('/category_job', [App\Http\Controllers\CategoryScoreController::class, 'showCategoryJob']);
Route::put('/category_job/{category_job}', [App\Http\Controllers\CategoryScoreController::class, 'updateCategoryJob']);
Route::delete('/category_job/{category_job}', [App\Http\Controllers\CategoryScoreController::class, 'deleteCategoryJob']);
//formation_recommendation
Route::post('/formation_recommendation', [App\Http\Controllers\FormationRecommendation::class, 'create_formation_recommendation']);
Route::delete('/formation_recommendation/{Formation_recommendation}', [App\Http\Controllers\FormationRecommendation::class, 'delete_formation_recommendation']);
Route::put('/formation_recommendation/{Formation_recommendation}', [App\Http\Controllers\FormationRecommendation::class, 'update_formation_recommendation']);
Route::get('/formation_recommendation/{id}', [App\Http\Controllers\FormationRecommendation::class, 'read_formation_recommendation']);
Route::get('/formation_recommendation', [App\Http\Controllers\FormationRecommendation::class, 'show_formation_recommendations']);
//job_recommendation
Route::post('/job_recommendation', [App\Http\Controllers\JobRecommendation::class, 'create_job_recommendation']);
Route::delete('/job_recommendation/{Job_recommendation}', [App\Http\Controllers\JobRecommendation::class, 'delete_job_recommendation']);
Route::put('/job_recommendation/{Job_recommendation}', [App\Http\Controllers\JobRecommendation::class, 'update_job_recommendation']);
Route::get('/job_recommendation/{id}', [App\Http\Controllers\JobRecommendation::class, 'read_job_recommendation']);
Route::get('/job_recommendation', [App\Http\Controllers\JobRecommendation::class, 'show_job_recommendations']);
//level_recommendation
Route::post('/level_recommendation', [App\Http\Controllers\LevelRecommendation::class, 'create_level_recommendation']);
Route::delete('/level_recommendation/{Level_recommendation}', [App\Http\Controllers\LevelRecommendation::class, 'delete_level_recommendation']);
Route::put('/level_recommendation/{Level_recommendation}', [App\Http\Controllers\LevelRecommendation::class, 'update_level_recommendation']);
Route::get('/level_recommendation/{id}', [App\Http\Controllers\LevelRecommendation::class, 'read_level_recommendation']);
Route::get('/level_recommendation', [App\Http\Controllers\LevelRecommendation::class, 'show_level_recommendations']);
//student_coach_meeting
Route::post('/student_coach_meeting', [App\Http\Controllers\StudentCoachMeeting::class, 'create_student_coach_meeting']);
Route::delete('/student_coach_meeting/{Student_coach_meeting}', [App\Http\Controllers\StudentCoachMeeting::class, 'delete_student_coach_meeting']);
Route::put('/student_coach_meeting/{Student_coach_meeting}', [App\Http\Controllers\StudentCoachMeeting::class, 'update_student_coach_meeting']);
Route::get('/student_coach_meeting/{id}', [App\Http\Controllers\StudentCoachMeeting::class, 'read_student_coach_meeting']);
Route::get('/student_coach_meeting', [App\Http\Controllers\StudentCoachMeeting::class, 'show_student_coach_meetings']);
//invoice
Route::post('/invoice', [App\Http\Controllers\InvoiceController::class, 'create_invoice']);
Route::delete('/invoice/{Invoice}', [App\Http\Controllers\InvoiceController::class, 'delete_invoice']);
Route::put('/invoice/{invoice}', [App\Http\Controllers\InvoiceController::class, 'update_invoice']);
Route::get('/invoice/{id}', [App\Http\Controllers\InvoiceController::class, 'read_invoice']);
Route::get('/invoice', [App\Http\Controllers\InvoiceController::class, 'show_invoices']);
//partner
Route::post('/partner', [App\Http\Controllers\PartnerController::class, 'create_partner']);
Route::delete('/partner/{Partner}', [App\Http\Controllers\PartnerController::class, 'delete_partner']);
Route::put('/partner/{Partner}', [App\Http\Controllers\PartnerController::class, 'update_partner']);
Route::get('/partner/{id}', [App\Http\Controllers\PartnerController::class, 'read_partner']);
Route::get('/partner', [App\Http\Controllers\PartnerController::class, 'show_partners']);
//document
Route::post('/document', [App\Http\Controllers\DocumentController::class, 'create_document']);
Route::delete('/document/{Document}', [App\Http\Controllers\DocumentController::class, 'delete_document']);
Route::put('/document/{Document}', [App\Http\Controllers\DocumentController::class, 'update_document']);
Route::get('/document/{id}', [App\Http\Controllers\DocumentController::class, 'read_document']);
Route::get('/document', [App\Http\Controllers\DocumentController::class, 'show_documents']);
//inscription
Route::post('/inscription', [App\Http\Controllers\InscriptionController::class, 'create_inscription']);
Route::delete('/inscription/{Inscription}', [App\Http\Controllers\InscriptionController::class, 'delete_inscription']);
Route::put('/inscription/{Inscription}', [App\Http\Controllers\InscriptionController::class, 'update_inscription']);
Route::get('/inscription/{id}', [App\Http\Controllers\InscriptionController::class, 'read_inscription']);
Route::get('/inscription', [App\Http\Controllers\InscriptionController::class, 'show_inscriptions']);
//program
Route::post('/program', [App\Http\Controllers\ProgramController::class, 'create_program']);
Route::delete('/program/{Program}', [App\Http\Controllers\ProgramController::class, 'delete_program']);
Route::put('/program/{Program}', [App\Http\Controllers\ProgramController::class, 'update_program']);
Route::get('/program/{id}', [App\Http\Controllers\ProgramController::class, 'read_program']);
Route::get('/program', [App\Http\Controllers\ProgramController::class, 'show_programs']);
//inscription_status
Route::post('/inscription_status', [App\Http\Controllers\InscriptionStatus::class, 'create_inscription_status']);
Route::delete('/inscription_status/{Inscription_status}', [App\Http\Controllers\InscriptionStatus::class, 'delete_inscription_status']);
Route::put('/inscription_status/{Inscription_status}', [App\Http\Controllers\InscriptionStatus::class, 'update_inscription_status']);
Route::get('/inscription_status/{id}', [App\Http\Controllers\InscriptionStatus::class, 'read_inscription_status']);
Route::get('/inscription_status', [App\Http\Controllers\InscriptionStatus::class, 'show_inscription_status']);
//student_document
Route::post('/student_document', [App\Http\Controllers\StudentDocument::class, 'create_student_document']);
Route::delete('/student_document/{Student_document}', [App\Http\Controllers\StudentDocument::class, 'delete_student_document']);
Route::put('/student_document/{Student_document}', [App\Http\Controllers\StudentDocument::class, 'update_student_document']);
Route::get('/student_document/{id}', [App\Http\Controllers\StudentDocument::class, 'read_student_document']);
Route::get('/student_document', [App\Http\Controllers\StudentDocument::class, 'show_student_documents']);

//student
Route::post('/student', [App\Http\Controllers\StudentController::class, 'store']);
Route::get('/student', [App\Http\Controllers\StudentController::class, 'index']);
Route::put('/student/{student}', [App\Http\Controllers\StudentController::class, 'update']);
Route::delete('/student/{student}', [App\Http\Controllers\StudentController::class, 'destroy']);
Route::put('/search/{data}', [App\Http\Controllers\StudentController::class, 'search']);
//language
Route::post('/language', [App\Http\Controllers\LanguageController::class, 'index']);
Route::get('/language', [App\Http\Controllers\LanguageController::class, 'showLanguage']);
Route::put('/language/{language}', [App\Http\Controllers\LanguageController::class, 'updateLanguage']);
Route::delete('/language/{language}', [App\Http\Controllers\LanguageController::class, 'deleteLanguage']);
//category
Route::post('/category', [App\Http\Controllers\CategoryController::class, 'index']);
Route::put('/category/{category}', [App\Http\Controllers\CategoryController::class, 'updateCategory']);
Route::delete('/category/{category}', [App\Http\Controllers\CategoryController::class, 'deleteCategory']);
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'showCategory']);
//question
Route::get('/question', [App\Http\Controllers\QuestionController::class, 'showQuestion']);
Route::post('/question', [App\Http\Controllers\QuestionController::class, 'index']);
Route::put('/question/{question}', [App\Http\Controllers\QuestionController::class, 'updateQuestion']);
Route::delete('/question/{question}', [App\Http\Controllers\QuestionController::class, 'deleteQuestion']);
//answer
Route::post('/answer', [App\Http\Controllers\AnswerController::class, 'index']);
Route::get('/answer', [App\Http\Controllers\AnswerController::class, 'showAnswer']);
Route::put('/answer/{answer}', [App\Http\Controllers\AnswerController::class, 'updateAnswer']);
Route::delete('/answer/{answer}', [App\Http\Controllers\AnswerController::class, 'deleteAnswer']);
//test
Route::post('/test', [App\Http\Controllers\TestController::class, 'index']);
Route::get('/test', [App\Http\Controllers\TestController::class, 'showTest']);
Route::put('/test/{test}', [App\Http\Controllers\TestController::class, 'updateTest']);
Route::delete('/test/{test}', [App\Http\Controllers\TestController::class, 'deleteTest']);
//weight
Route::post('/weight', [App\Http\Controllers\WeightController::class, 'index']);
Route::get('/weight', [App\Http\Controllers\WeightController::class, 'showWeight']);
Route::put('/weight/{weight}', [App\Http\Controllers\WeightController::class, 'updateWeight']);
Route::delete('/weight/{weight}', [App\Http\Controllers\WeightController::class, 'deleteWeight']);
//axe
Route::post('/axe', [App\Http\Controllers\AxeController::class, 'index']);
Route::get('/axe', [App\Http\Controllers\AxeController::class, 'showAxe']);
Route::get('/axe/{id}', [App\Http\Controllers\AxeController::class, 'readAxe']);
Route::put('/axe/{axe}', [App\Http\Controllers\AxeController::class, 'updateAxe']);
Route::delete('/axe/{axe}', [App\Http\Controllers\AxeController::class, 'deleteAxe']);
//coach
Route::post('/coach', [App\Http\Controllers\CoachController::class, 'index']);
Route::get('/coach', [App\Http\Controllers\CoachController::class, 'showCoach']);
Route::put('/coach/{coach}', [App\Http\Controllers\CoachController::class, 'updateCoach']);
Route::delete('/coach/{coach}', [App\Http\Controllers\CoachController::class, 'deleteCoach']);
//categoryScore
Route::post('/category_score', [App\Http\Controllers\CategoryScoreController::class, 'index']);
Route::get('/category_score', [App\Http\Controllers\CategoryScoreController::class, 'showCategoryScore']);
Route::put('/category_score/{category_score}', [App\Http\Controllers\CategoryScoreController::class, 'updateCategoryScore']);
Route::delete('/category_score/{category_score}', [App\Http\Controllers\CategoryScoreController::class, 'deleteCategoryScore']);
//studentCoach
Route::post('/student_coach', [App\Http\Controllers\StudentCoachController::class, 'index']);
Route::get('/student_coach', [App\Http\Controllers\StudentCoachController::class, 'showStudentCoach']);
Route::put('/student_coach/{studentCoach}', [App\Http\Controllers\StudentCoachController::class, 'updateStudentCoach']);
Route::delete('/student_coach/{studentCoach}', [App\Http\Controllers\StudentCoachController::class, 'deleteStudentCoach']);
//studentSubscriptionAt
Route::post('/student_subscription_at', [App\Http\Controllers\StudentSubscriptionAtController::class, 'index']);
Route::get('/student_subscription_at', [App\Http\Controllers\StudentSubscriptionAtController::class, 'show']);
Route::put('/student_subscription_at/{student_subscription_at}', [App\Http\Controllers\StudentSubscriptionAtController::class, 'update']);
Route::delete('/student_subscription_at/{student_subscription_at}', [App\Http\Controllers\StudentSubscriptionAtController::class, 'delete']);
//subscription
Route::post('/subscription', [App\Http\Controllers\SubscriptionController::class, 'index']);
Route::get('/subscription', [App\Http\Controllers\SubscriptionController::class, 'showSubscription']);
Route::put('/subscription/{subscription}', [App\Http\Controllers\SubscriptionController::class, 'updatesubscription']);
Route::delete('/subscription/{subscription}', [App\Http\Controllers\SubscriptionController::class, 'deleteSubscription']);
//categoryJob
Route::post('/category_job', [App\Http\Controllers\CategoryScoreController::class, 'index']);
Route::get('/category_job', [App\Http\Controllers\CategoryScoreController::class, 'showCategoryJob']);
Route::put('/category_job/{category_job}', [App\Http\Controllers\CategoryScoreController::class, 'updateCategoryJob']);
Route::delete('/category_job/{category_job}', [App\Http\Controllers\CategoryScoreController::class, 'deleteCategoryJob']);

//student_test
Route::post('/student_test', [App\Http\Controllers\StudentTestController::class, 'index']);
Route::delete('/student_test/{Student_document}', [App\Http\Controllers\StudentTestController::class, 'deleteStudentTest']);
Route::put('/student_test/{Student_document}', [App\Http\Controllers\StudentTestController::class, 'updateStudentTest']);
Route::get('/student_test', [App\Http\Controllers\StudentTestController::class, 'showStudentTest']);
//test_axe
Route::post('/test_axe', [App\Http\Controllers\TestAxeController::class, 'index']);
Route::delete('/test_axe/{test_axe}', [App\Http\Controllers\TestAxeController::class, 'deleteTestAxe']);
Route::put('/test_axe/{test_axe}', [App\Http\Controllers\TestAxeController::class, 'updateTestAxe']);
Route::get('/test_axe/{id}', [App\Http\Controllers\TestAxeController::class, 'read_student_document']);
Route::get('/test_axe', [App\Http\Controllers\TestAxeController::class, 'showTestAxe']);
//test_axe
Route::post('/question_test', [App\Http\Controllers\QuestionTestController::class, 'index']);
Route::delete('/question_test/{question_test}', [App\Http\Controllers\QuestionTestController::class, 'deleteQuestionTest']);
Route::put('/question_test/{question_test}', [App\Http\Controllers\QuestionTestController::class, 'updateQuestionTest']);
Route::get('/question_test', [App\Http\Controllers\QuestionTestController::class, 'shwoQuestionTest']);

Route::middleware('auth:api')->get('/users', function (Request $request) {
    return $request->user();
});
