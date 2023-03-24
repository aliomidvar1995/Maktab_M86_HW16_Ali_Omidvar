<?php

namespace controller;

use core\Application;
use core\Controller;
use core\Request;
use core\Response;
use model\Register;

class LogoutController extends Controller
{
    public static function create(Request $request, Response $response)
    {
        Application::$app->session->remove(Register::PRIMARY_KEY);
        Application::$app->user = null;
        $response->redirect('/login');
    }
}