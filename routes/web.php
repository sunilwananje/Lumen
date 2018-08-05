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

$router->get('/callback', function () {
    //echo "s";
     $result = DB::table('oauth_clients')->where('id', 1)->first();
     $result = App\User::where('id', 1)->first();
    dd($result);
    // $http = new GuzzleHttp\Client;

    // $response = $http->post('http://localhost/lumen/public/oauth/token', [
    //     'form_params' => [
    //         'grant_type' => 'password',
    //         'client_id' => '1',
    //         'client_secret' => 'client-secret',
    //         'redirect_uri' => 'http://example.com/callback',
    //         'code' => $request->code,
    //     ],
    // ]);

     }
);

$router->group(['prefix' => 'api/v1'], function($router)
{
    $router->post('login','UserController@login');
    //$router->get('details','UserController@details');
    $router->group(['middleware' => 'auth:api'], function($router){
        $router->get('details','UserController@details');
        // Posts
        $router->get('/posts','PostController@index');
        $router->post('/posts','PostController@store');
        //$router->get('/posts/{post_id}','PostController@show');
        $router->put('/posts/{post_id}', 'PostController@update');
        $router->delete('/posts/{post_id}', 'PostController@destroy');
    });
});

