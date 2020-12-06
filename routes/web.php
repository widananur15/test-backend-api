<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(["prefix" => "/api/v1"], function ($router){

    $router->group(["prefix" => "/users"], function ($router) {
        $router->post('/login', "LoginController@auth");
    });

    $router->group(['middleware' => 'auth:api', "prefix" => "/users"], function ($router) {
        $router->get('/logout', "LoginController@logout");
    });

    $router->group(['middleware' => 'auth:api', "prefix" => "/topics"], function ($router) {
        $router->post('/create', "TopicsController@addTopic");
        $router->put('/update/{id}', "TopicsController@updateTopic");
        $router->get('/list', "TopicsController@getTopicList");
        $router->get('/{slugTopic}', "TopicsController@getArticleInTopics");
    });

    $router->group(['middleware' => 'auth:api', "prefix" => "/article"], function ($router) {
    $router->get("/{slugArticle}", "ArticleController@findArticleBySlug");
        $router->post('/create', "ArticleController@addArticle");
        $router->put('/update/{id}', "ArticleController@updateArticle");
//        $router->get('/list', "ArticleController@getArticleList");
    });

});
