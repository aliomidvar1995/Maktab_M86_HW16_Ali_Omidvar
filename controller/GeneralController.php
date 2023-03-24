<?php

namespace controller;

use core\Application;
use core\Controller;
use core\Request;
use core\Response;
use model\Doctor;

class GeneralController extends Controller
{
    public static function create(Request $request, Response $response)
    {
        $doctorModel = new Doctor();
        $users = $doctorModel->index('پزشک عمومی');
        if(Application::$app->isGuest()){
            $response->renderView('main', 'brain', [
                'user' => Application::$app->user,
                'users' => $users
            ]);
        }
        $response->renderView('main', 'brain', [
            'user' => Application::$app->user,
            'users' => $users
        ]);
    }
}