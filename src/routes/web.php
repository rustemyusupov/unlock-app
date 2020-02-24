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
$router->get('/', function () use ($router) {
    return $router->app->version();
});

/**
 * Routes for the unlocking doors
 */
$router->post('/unlock/{scope}', [
    'uses'       => 'LockController@unlock',
    'middleware' => 'scope:open-tunnel,open-office'
]);

/**
 * Routes for the retrieving history
 */
$router->get('/history', [
    'uses'       => 'LockController@history',
    'middleware' => 'auth'
]);
