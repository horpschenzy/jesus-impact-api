<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'UserController@register');
Route::get('test', 'UserController@test');
Route::post('login', 'UserController@authenticate');
Route::get('open', 'DataController@open');
Route::get('viewpermissions', 'RolePermissionController@permissions');
Route::get('viewroles', 'RolePermissionController@role');
Route::post('createrole', 'RolePermissionController@createRole');
Route::post('createpermission', 'RolePermissionController@createPermission');
Route::post('attachpermissiontorole', 'RolePermissionController@attachPermissionToRole');
Route::post('attachroletoUser', 'RolePermissionController@attachRoleToUser');
Route::post('attachpermissiontoUser', 'RolePermissionController@attachPermissionToUser');
Route::post('getuserrole', 'RolePermissionController@getUserRole');
Route::post('editpermission', 'RolePermissionController@editPermission');
Route::post('editrole', 'RolePermissionController@editRole');
Route::post('deleterole', 'RolePermissionController@deleteRole');
Route::post('deletepermission', 'RolePermissionController@deletePermission');

Route::group([
    'namespace' => 'Auth',
    'middleware' => 'api',
    'prefix' => 'password'
], function () {
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});


//  Route::group(['middleware' => 'auth:api'], function () {
//  Route::post('change_password', 'Api\AuthController@change_password');
// });

Route::group(['middleware' => ['auth']], function() {
    Route::get('getAuthUser', 'UserController@getAuthenticatedUser');
    Route::post('changepassword', 'UserController@changePassword');
    Route::post('updateuser', 'UserController@updateUser');
    Route::post('updateprofilepicture', 'UserController@UpdateProfilePicture');

    //User Feed
    Route::post('/create/feed', 'FeedController@store');
    Route::get('/user/feeds', 'FeedController@index');
    Route::get('closed', 'DataController@closed');

    //user comment
    Route::post('/feed/comment', 'CommentController@store');
    Route::post('/feed/reply', 'CommentController@replyStore');

    //feed like and dislike
    Route::post('/feed/like', 'FeedController@toggleLike');
    Route::post('/feed/unlike', 'FeedController@toggleLike');

    //FOLLOW AND UNFOLLOW
    Route::post('/user/follow', 'UserController@toggleFollow');
    Route::post('/user/unfollow', 'UserController@toggleFollow');

    Route::get('/logout', 'UserController@logout');
});
