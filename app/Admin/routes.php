<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('category', CategoryController::class);
    $router->resource('article', ArticleController::class);
    $router->resource('contact', ContactController::class);
    $router->resource('lesson', LessonController::class);
    $router->resource('comment', CommentController::class);

});
