<?php

namespace controller;

use core\Application;
use core\Controller;
use core\Request;
use core\Response;

class ManagerController extends Controller
{
    public static function create(Request $request, Response $response)
    {
        $response->renderView('auth', 'manager', [
            'user' => Application::$app->user
        ]);
    }
}