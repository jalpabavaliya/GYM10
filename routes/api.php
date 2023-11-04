<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MealController;
use App\Http\Controllers\API\PostureController;
use App\Http\Controllers\API\SubscriptionController;
use App\Http\Controllers\API\WorkoutController;

Route::post('social_login', 'App\Http\Controllers\AuthController@social_login');
Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('resetPwd', 'resetPwd');
    // Route::post('changePwd', 'changePwd');
    Route::post('resendotp', 'resendotp');
    Route::post('forgotpwd', 'forgotpwd');
    Route::post('verificationEmailCode', 'verificationEmailCode');
    Route::post('verifyRegistrationEmail', 'verifyRegistrationEmail');
    Route::post('login', 'login')->name('login');
    Route::get('unAuthorized', 'unAuthorized')->name('unAuthorized');
    Route::post('signinWithGoogle', 'signinWithGoogle')->name('signinWithGoogle');
});

Route::middleware('auth:sanctum')->group(function () {
    /* chat */
    Route::post('/sendMessage', 'Chatify\Http\Controllers\Api\MessagesController@send')->name('api.send.message');
    Route::post('/fetchMessages', 'Chatify\Http\Controllers\Api\MessagesController@fetch')->name('api.fetch.messages');
    Route::post('/makeSeen', 'Chatify\Http\Controllers\Api\MessagesController@seen')->name('api.messages.seen');
    Route::get('/getContacts', 'Chatify\Http\Controllers\Api\MessagesController@getContacts')->name('api.contacts.get');
    Route::post('/star', 'Chatify\Http\Controllers\Api\MessagesController@favorite')->name('api.star');
    Route::post('/favorites', 'Chatify\Http\Controllers\Api\MessagesController@getFavorites')->name('api.favorites');
    Route::post('/shared', 'Chatify\Http\Controllers\Api\MessagesController@sharedPhotos')->name('api.shared');
    Route::post('/deleteConversation', 'Chatify\Http\Controllers\Api\MessagesController@deleteConversation')->name('api.conversation.delete');
    Route::post('/setActiveStatus', 'Chatify\Http\Controllers\Api\MessagesController@setActiveStatus')->name('api.activeStatus.set');

    // Route::get('/download/{fileName}', 'Chatify\Http\Controllers\Api\MessagesController@download')->name('api.'.config('chatify.attachments.download_route_name'));
    // Route::post('/favorites', 'MessagesController@getFavorites')->name('api.favorites');
    // Route::get('/search', 'MessagesController@search')->name('api.search');
    // Route::post('/shared', 'MessagesController@sharedPhotos')->name('api.shared');
    // Route::post('/deleteConversation', 'MessagesController@deleteConversation')->name('api.conversation.delete');
    // Route::post('/updateSettings', 'MessagesController@updateSettings')->name('api.avatar.update');
    // Route::post('/setActiveStatus', 'MessagesController@setActiveStatus')->name('api.activeStatus.set');


    /* other api */
    Route::post('changePwd', [AuthController::class, 'changePwd']);
    Route::post('updateProfile', [AuthController::class, 'updateProfile']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('postureImage', [PostureController::class, 'postureImage']);

    Route::get('meallist', [MealController::class, 'meallist']);
    Route::get('mealdetail/{id}', [MealController::class, 'mealdetail']);
    Route::get('mealschedule', [MealController::class, 'mealschedule']);
    Route::get('dailymeal', [MealController::class, 'dailymeal']);

    Route::get('subscriptionlist', [SubscriptionController::class, 'subscriptionlist']);

    Route::post('heartRate', [AuthController::class, 'heartRate']);
    Route::get('showProfile', [AuthController::class, 'showProfile']);
    Route::post('update_Profile', [AuthController::class, 'update_Profile']);
    Route::get('profile_delete/{id}', [AuthController::class, 'profile_delete']);
    Route::get('dashboard', [AuthController::class, 'dashboard']);

    Route::get('workout_list', [WorkoutController::class, 'workout_list']);
    Route::get('exercise_list', [WorkoutController::class, 'exercise_list']);
    Route::get('food_list', [WorkoutController::class, 'food_list']);

    // Route::get('meal/delete/{id}', [MealController::class, 'destroy'])->name('meal.destroy');
});
