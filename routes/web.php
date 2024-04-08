<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoCourseController;
use App\Models\Track;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $tracks_courses=Track::with("courses")->orderBy("id","desc")->limit(3)->get();
    return view('welcome',compact("tracks_courses"));
})->name('welcome');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("/courses/{slug}",[App\Http\Controllers\User\CourseController::class, 'index'])->name("show-course")->middleware("auth");
Route::get("/courses/{slug}/quizzes/{name}",[App\Http\Controllers\ExamController::class, 'index'])->name("show-quiz")->middleware("auth");
Route::post("/courses/{slug}/quizzes/{name}/submit",[App\Http\Controllers\ExamController::class, 'submit'])->name("submit-quiz")->middleware("auth");
Route::get("/my-courses",[App\Http\Controllers\User\CourseController::class, 'my_courses'])->name("my-courses")->middleware("auth");
Route::get("/allcourses",[App\Http\Controllers\User\CourseController::class, 'get_all_courses'])->name("all-courses");
Route::get("/course-info/{slug}",[App\Http\Controllers\User\CourseController::class, 'get_course_info'])->name("course-info");
Route::get("/user-profile",[App\Http\Controllers\UserProfileController::class, 'index'])->name("user-profile");
Route::put("/update-user-profile/{user}",[App\Http\Controllers\UserProfileController::class, 'update'])->name("update-user-profile");
Route::get("/search",[App\Http\Controllers\SearchController::class, 'index'])->name("search");
Route::get("/addToCart/{course}",[App\Http\Controllers\CardController::class, 'addToCart'])->name("cart.add");
Route::get("/shopping-cart",[App\Http\Controllers\CardController::class, 'showCart'])->name("cart.show");
Route::delete("/remove-course/{course}",[App\Http\Controllers\CardController::class, 'removefromCart'])->name("cart.remove");
Route::put("/update-qty/{course}",[App\Http\Controllers\CardController::class, 'updateqty'])->name("cart.updaeqty");
Route::post("/checkout",[App\Http\Controllers\CardController::class, 'checkout'])->name("checkout")->middleware("auth");
Route::post("/upload-image-prfile/{user}",[App\Http\Controllers\UserProfileController::class, 'upload_image'])->name("upload_image")->middleware("auth");
Route::resource('user/favorilerim', 'App\Http\Controllers\FavoriController')->middleware("auth");
Route::get("/payment",[App\Http\Controllers\CardController::class, 'show_payment_page'])->name("show-payment-page")->middleware("auth");
Auth::routes();



//admin routes
Route::group(['middleware' => ['auth','adminowner']], function () {
    //admin dashboard page route
    Route::get('/admin/dashboard', 'App\Http\Controllers\HomeController@index')->name('dashboard');
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::resource('admin', 'App\Http\Controllers\AdminController', ['except' => ['show']]);
	Route::resource('admin/tracks', 'App\Http\Controllers\TrackController', ['except' => ['show']]);
	Route::resource('admin/quizzes', 'App\Http\Controllers\QuizController');
	Route::resource('admin/courses', 'App\Http\Controllers\CourseController');
	Route::resource('admin/courses.video', 'App\Http\Controllers\VideoCourseController');
	Route::resource('admin/courses.quiz', 'App\Http\Controllers\QuizCourseController');
	Route::resource('admin/quizzes.questions', 'App\Http\Controllers\QuestionController');
	Route::resource('admin/questions', 'App\Http\Controllers\QuestionController');
	Route::resource('admin/videos', 'App\Http\Controllers\VideoController', ['except' => ['show']]);

	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade');
	Route::get('map', function () {return view('pages.maps');})->name('map');
	Route::get('icons', function () {return view('pages.icons');})->name('icons');
	Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});


