<?php

namespace controller;

use core\Application;
use core\Controller;
use core\Request;
use core\Response;
use model\Login;
use model\Register;

class LoginController extends Controller
{
    public static function create(Request $request, Response $response)
    {
        $loginModel = new Login();
        $response->renderView('auth', 'login', [
            'errors' => $loginModel->errors
        ]);
    }

    public static function show(Request $request, Response $response)
    {
        $loginModel = new Login();
        $loginModel->loadData($request->getBody());
        $loginModel->validation();
        $loginModel->loginValidation();
        if(empty($loginModel->errors)) {
            $user = $loginModel->findOne(['email' => $loginModel->email]);
            // print('<pre>');
            // print_r($user);
            // print('</pre>');
            // exit();
            Application::$app->session->set(Register::PRIMARY_KEY, $user->{Register::PRIMARY_KEY});
            // var_dump($user);
            // exit();
            $response->redirect("/".$user->rule);
        }
        $response->renderView('auth', 'login', [
            'model' => $loginModel,
            'errors' => $loginModel->errors
        ]);
    }
}