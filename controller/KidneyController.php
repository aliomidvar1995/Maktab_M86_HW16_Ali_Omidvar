<?php

namespace controller;

use core\Application;
use core\Controller;
use core\Request;
use core\Response;
use model\Doctor;

class KidneyController extends Controller
{
    public static function create(Request $request, Response $response)
    {
        $doctorModel = new Doctor();
        $users = $doctorModel->index('متخصص کلیه');
        if(Application::$app->isGuest()){
            Application::$app->response->renderView('main', 'kidney', [
                'user' => Application::$app->user,
                'users' => $users
            ]);
        }
        Application::$app->response->renderView('main', 'kidney', [
            'user' => Application::$app->user,
            'users' => $users
        ]);
    }
}