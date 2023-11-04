<?php

use App\Http\Controllers\AssignMealController;
use App\Http\Controllers\AssignWorkoutController;
use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\ExerciseCategories;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\MealCategoriesController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\PostureController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WorkOutsController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Route::get('/password', [ForgotController::class, 'password'])->name('password');
Route::post('/password/forgot', [ForgotController::class, 'forgot'])->name('password.forgot');
Route::post('/password/otpsend', [ForgotController::class, 'otpsend'])->name('password.otpsend');
Route::get('/password/otpsend', [ForgotController::class, 'otpsend'])->name('password.otpsend');
Route::get('/password/password', [ForgotController::class, 'create'])->name('password.create');

Route::post('/', [ForgotController::class, 'storepassword'])->name('password.storepassword');
// Route::get('/password/newpassword', [ForgotController::class, 'newpassword'])->name('password.newpassword');



// Route::get('/users',CreateChat::class)->name('users');
// Route::get('/chat{key?}',Main::class)->name('chat');

Route::get('/firebase', function () {
    return view('firebase');
});
Route::get('/create-password/{id}', [App\Http\Controllers\UserController::class, 'createPassword']);
Route::post('users/passwordstore', [UserController::class, 'passwordstore'])->name('users.passwordstore');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {
    // Route::resource('roles', RoleController::class);
    // Route::resource('users', UserController::class);
    // Route::resource('products', ProductController::class);
});

Route::get('/team', [App\Http\Controllers\TrainerController::class, 'index'])->name('team');

Route::get('users', [UserController::class, 'index']);
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('users/list', [UserController::class, 'getUser'])->name('users.list');
Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::get('users/show/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('users/chart/{id}', [UserController::class, 'chart'])->name('users.chart');
Route::patch('users/update/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::post('users/store', [UserController::class, 'store'])->name('users.store');
Route::post('users/status', [UserController::class, 'status'])->name('users.status');

// Route::get('calendar', [CalendarController::class, 'index']);

Route::get('calendar', [CalendarController::class, 'index']);
Route::post('fullcalenderAjax', [CalendarController::class, 'ajax']);

Route::get('roles', [RoleController::class, 'index']);
Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('roles/list', [RoleController::class, 'getRole'])->name('roles.list');
Route::get('roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
Route::patch('roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::get('roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');

Route::get('tags', [TagsController::class, 'index']);
Route::get('tags', [TagsController::class, 'index'])->name('tags.index');
Route::get('tags/edit/{id}', [TagsController::class, 'edit'])->name('tags.edit');
Route::patch('tags/update/{id}', [TagsController::class, 'update'])->name('tags.update');
Route::get('tags/delete/{id}', [TagsController::class, 'destroy'])->name('tags.destroy');
Route::get('tags/create', [TagsController::class, 'create'])->name('tags.create');
Route::post('tags/store', [TagsController::class, 'store'])->name('tags.store');
Route::get('tags/list', [TagsController::class, 'getTags'])->name('tags.list');

Route::get('exercise_categories', [ExerciseCategories::class, 'index']);
Route::get('exercise_categories', [ExerciseCategories::class, 'index'])->name('exercise_categories.index');
Route::get('exercise_categories/edit/{id}', [ExerciseCategories::class, 'edit'])->name('exercise_categories.edit');
Route::patch('exercise_categories/update/{id}', [ExerciseCategories::class, 'update'])->name('exercise_categories.update');
Route::get('exercise_categories/delete/{id}', [ExerciseCategories::class, 'destroy'])->name('exercise_categories.destroy');
Route::get('exercise_categories/create', [ExerciseCategories::class, 'create'])->name('exercise_categories.create');
Route::post('exercise_categories/store', [ExerciseCategories::class, 'store'])->name('exercise_categories.store');

Route::get('exercises', [ExerciseCategories::class, 'index']);
Route::get('exercises', [ExerciseCategories::class, 'index'])->name('exercise.index');
Route::get('exercises/edit/{id}', [ExerciseCategories::class, 'edit'])->name('exercise.edit');
Route::patch('exercises/update/{id}', [ExerciseCategories::class, 'update'])->name('exercise.update');
Route::get('exercises/delete/{id}', [ExerciseCategories::class, 'destroy'])->name('exercise.destroy');
Route::get('exercises/create', [ExerciseCategories::class, 'create'])->name('exercise.create');
Route::post('exercises/store', [ExerciseCategories::class, 'store'])->name('exercise.store');

Route::get('workouts', [WorkOutsController::class, 'index']);
Route::get('workouts', [WorkOutsController::class, 'index'])->name('workouts.index');
Route::get('workouts/edit/{id}', [WorkOutsController::class, 'edit'])->name('workouts.edit');
Route::patch('workouts/update/{id}', [WorkOutsController::class, 'update'])->name('workouts.update');
Route::get('workouts/delete/{id}', [WorkOutsController::class, 'destroy'])->name('workouts.destroy');
Route::get('workouts/create', [WorkOutsController::class, 'create'])->name('workouts.create');
Route::post('workouts/store', [WorkOutsController::class, 'store'])->name('workouts.store');
Route::get('workouts/list', [WorkOutsController::class, 'getWorkouts'])->name('workouts.list');

Route::get('programs', [ProgramController::class, 'index']);
Route::get('programs', [ProgramController::class, 'index'])->name('programs.index');
Route::post('programs/store', [ProgramController::class, 'store'])->name('programs.store');
Route::get('programs/list', [ProgramController::class, 'getProgram'])->name('programs.list');
Route::get('programs/delete/{id}', [ProgramController::class, 'destroy'])->name('programs.destroy');
Route::get('programs/edit/{id}', [ProgramController::class, 'edit'])->name('programs.edit');
Route::get('programs/workout/{id}', [ProgramController::class, 'workout'])->name('programs.workout');
Route::post('programs/add', [ProgramController::class, 'add'])->name('programs.add');





Route::get('meal-category', [MealCategoriesController::class, 'index']);
Route::get('meal-category', [MealCategoriesController::class, 'index'])->name('meal-category.index');
Route::get('meal-category/edit/{id}', [MealCategoriesController::class, 'edit'])->name('meal-category.edit');
Route::patch('meal-category/update/{id}', [MealCategoriesController::class, 'update'])->name('meal-category.update');
Route::get('meal-category/delete/{id}', [MealCategoriesController::class, 'destroy'])->name('meal-category.destroy');
Route::get('meal-category/create', [MealCategoriesController::class, 'create'])->name('meal-category.create');
Route::post('meal-category/store', [MealCategoriesController::class, 'store'])->name('meal-category.store');
Route::get('meal-category/list', [MealCategoriesController::class, 'getMealCategory'])->name('meal-category.list');

Route::get('meal', [MealController::class, 'index']);
Route::get('meal', [MealController::class, 'index'])->name('meal.index');
Route::get('meal/edit/{id}', [MealController::class, 'edit'])->name('meal.edit');
Route::patch('meal/update/{id}', [MealController::class, 'update'])->name('meal.update');
Route::get('meal/delete/{id}', [MealController::class, 'destroy'])->name('meal.destroy');
Route::get('meal/create', [MealController::class, 'create'])->name('meal.create');
Route::post('meal/store', [MealController::class, 'store'])->name('meal.store');
Route::get('meal/list', [MealController::class, 'getMeal'])->name('meal.list');
Route::post('meal/fetch', [MealController::class, 'fetchallproduct'])->name('meal/fetch');
Route::get('meal/getlist', [MealController::class, 'get_list'])->name('meal.getlist');





Route::get('mealPlan', [MealPlanController::class, 'index']);
Route::get('mealPlan', [MealPlanController::class, 'index'])->name('mealPlan.index');
Route::get('mealPlan/create', [MealPlanController::class, 'create'])->name('mealPlan.create');
Route::post('mealPlan/store', [MealPlanController::class, 'store'])->name('mealPlan.store');
Route::get('mealPlan/edit/{id}', [MealPlanController::class, 'edit'])->name('mealPlan.edit');



Route::get('food', [FoodController::class, 'index']);
Route::get('food', [FoodController::class, 'index'])->name('food.index');
Route::post('food/store', [FoodController::class, 'store'])->name('food.store');
Route::get('food/edit/{id}', [FoodController::class, 'edit'])->name('food.edit');
Route::get('food/delete/{id}', [FoodController::class, 'destroy'])->name('food.destroy');
Route::get('food/list', [FoodController::class, 'getFood'])->name('food.list');
// Route::get('food/get-list/{food_id}', [FoodController::class, 'get_list'])->name('food.get-list');
// Route::patch('food/update/{id}', [FoodController::class, 'update'])->name('food.update');

Route::get('assignWorkout', [AssignWorkoutController::class, 'index']);
Route::get('assignWorkout', [AssignWorkoutController::class, 'index'])->name('assignWorkout.index');
Route::get('assignWorkout/list', [AssignWorkoutController::class, 'getAssignWorkout'])->name('assignWorkout.list');
Route::post('assignWorkout/store', [AssignWorkoutController::class, 'store'])->name('assignWorkout.store');
Route::get('assignWorkout/edit/{id}', [AssignWorkoutController::class, 'edit'])->name('assignWorkout.edit');

Route::get('assignMeal', [AssignMealController::class, 'index']);
Route::get('assignMeal', [AssignMealController::class, 'index'])->name('assignMeal.index');
Route::get('assignMeal/list', [AssignMealController::class, 'getAssignMeal'])->name('assignMeal.list');
Route::post('assignMeal/store', [AssignMealController::class, 'store'])->name('assignMeal.store');
Route::get('assignMeal/edit/{id}', [AssignMealController::class, 'edit'])->name('assignMeal.edit');

Route::get('postureimage', [PostureController::class, 'index']);
Route::get('postureimage', [PostureController::class, 'index'])->name('postureimage.index');
Route::get('postureimage/list', [PostureController::class, 'getPosture'])->name('postureimage.list');
Route::get('postureimage/edit/{id}', [PostureController::class, 'edit'])->name('postureimage.edit');


Route::get('subscription', [SubscriptionController::class, 'index']);
Route::get('subscription', [SubscriptionController::class, 'index'])->name('subscription.index');
Route::post('subscription/store', [SubscriptionController::class, 'store'])->name('subscription.store');
Route::get('subscription/list', [SubscriptionController::class, 'getSubscription'])->name('subscription.list');
Route::get('subscription/delete/{id}', [SubscriptionController::class, 'destroy'])->name('subscription.destroy');
Route::get('subscription/edit/{id}', [SubscriptionController::class, 'edit'])->name('subscription.edit');




// Route::post('/save-token', [App\Http\Controllers\HomeController::class, 'saveToken'])->name('save-token');
// Route::post('/send-notification', [App\Http\Controllers\HomeController::class, 'sendNotification'])->name('send.notification');
