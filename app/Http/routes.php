<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', 'AdPushController@facebookConnect');


$app->get('/stock', 'AdPushController@stock');

$app->get('/feed', 'AdPushController@feed');

$app->get('/api/php/', function (){
    return "Please define the api you would like to access.";
});

$app->get('/api/php/adpush/', function (){
    return "Please declare which Facebook api you would like to use.";
});

$app->get('/api/php/adpush/facebook/', function (){
    return "You must specify a user to use the adPush api";
});


$app->group(['prefix' => 'api/php/adpush/facebook/{user}'], function () use ($app) { 

	//TODO: add middleware to authorise users

	$app->get('token', 'App\Http\Controllers\AdPushController@token');
	
	$app->get('permissions', 'App\Http\Controllers\AdPushController@permissions');

	$app->get('revokePermission', 'App\Http\Controllers\AdPushController@revokePermission');

	$app->get('insights', 'App\Http\Controllers\AdPushController@insights');

	$app->get('logout', 'App\Http\Controllers\AdPushController@logout');

	$app->get('getFeed', 'App\Http\Controllers\AdPushController@getFeed');

	//$app->get('StockSubmit', 'App\Http\Controllers\AdPushController@submitStock');
	
	$app->Post('StockSubmit', 'App\Http\Controllers\AdPushController@submitStock');

});
