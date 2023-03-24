<?php

namespace controller;

use core\Application;
use core\Controller;
use core\middlewares\AuthMiddleware;
use core\Request;
use core\Response;
use model\Register;

class RegisterController extends Controller
{

    public static function create(Request $request, Response $response)
    {
        $registerModel = new Register();
        $response->renderView('auth', 'register', [
            'errors' => $registerModel->errors
        ]);
    }

    public static function store(Request $request, Response $response)
    {
        $registerModel = new Register();
        $registerModel->loadData($request->getBody());
        $registerModel->validation();

        if(empty($registerModel->errors)) {
            $registerModel->save();
            Application::$app->session->setFlash('success', 'Thanks for registering');
            $user = $registerModel->findOne(['email' => $registerModel->email]);
            Application::$app->session->set(Register::PRIMARY_KEY, $user->{Register::PRIMARY_KEY});
            $response->redirect('/'.$user->rule);
        }
        $response->renderView('auth', 'register', [
            'model' => $registerModel,
            'errors' => $registerModel->errors
        ]);
    }
}