<?php

namespace controller;

use core\Application;
use core\Controller;
use core\Request;
use core\Response;

class HomeController extends Controller
{
    public static function create(Request $request, Response $response)
    {
        if(Application::$app->isGuest()){
            $response->renderView('main', 'home');
        }
        Application::$app->response->renderView('main', 'home', [
            'user' => Application::$app->user
        ]);
    }
}