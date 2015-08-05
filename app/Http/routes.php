<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use \Illuminate\Routing\Router;

Route::group(
    [
        'prefix'    => 'backend',
        'namespace' => 'Backend'
    ],
    function (Router $router) {
        $router->controller('auth', 'AuthController');
        $router->group(
            ['middleware' => 'auth'],
            function (Router $router) {
                $router->controller('category', 'CategoryController');
                $router->controller('article', 'ArticleController');
                $router->controller('/', 'MainController');
            }
        );
    }
);

Route::group(
    [
        'where' => [
            'category' => '[a-z0-9-]+',
            'slug'     => '[a-z0-9-]+',
            'id'       => '\d+'
        ]
    ],
    function (Router $router) {
        $router->get('{category}/{id}{slug?}', 'ContentController@article');
        $router->get('{category}', 'ContentController@category');
        $router->get('/', 'ContentController@index');
    }
);