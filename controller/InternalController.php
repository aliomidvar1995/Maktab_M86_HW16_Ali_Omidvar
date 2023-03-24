<?php

namespace controller;

use core\Application;
use core\Controller;
use core\Request;
use core\Response;
use model\Doctor;

class InternalController extends Controller
{
    public static function create(Request $request, Response $response)
    {
        $doctorModel = new Doctor();
        $users = $doctorModel->index('متخصص داخلی');
        if(Application::$app->isGuest()){
            $response->renderView('main', 'internal', [
                // 'user' => Application::$app->user,
                'users' => $users
            ]);
        }
        $response->renderView('main', 'internal', [
            'user' => Application::$app->user,
            'users' => $users
        ]);
    }
}