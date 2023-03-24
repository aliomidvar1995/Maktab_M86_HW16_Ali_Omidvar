<?php


namespace controller;
use core\Application;
use core\Controller;
use core\middlewares\AuthMiddleware;
use core\middlewares\DoctorMiddleware;
use core\Request;
use core\Response;
use model\Doctor;
use model\PatientDoctor;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['/doctor', '/patient']));
    }
    public static function create(Request $request, Response $response)
    {
//        $response->renderView('auth', 'doctor', [
//            'user' => Application::$app->user
//        ]);
        AuthMiddleware::execute();
        DoctorMiddleware::execute();
        $doctorModel = new Doctor();
        $doctorDoctor = new PatientDoctor();
        $doctorIndex = $doctorDoctor->doctorIndex(Application::$app->user->id);
        // var_dump($doctorIndex);die();
        $completed = $doctorModel->completed(Application::$app->user->id);
        $response->renderView('auth', 'doctor', [
            'user' => Application::$app->user,
            'completed' => $completed,
            'doctorIndex' => $doctorIndex
        ]);
    }
    public static function store(Request $request, Response $response) {
        $doctorModel = new Doctor();
        $doctorModel->image();
        $doctorModel->loadData($request->getBody());
        $doctorModel->save();
        $response->redirect('/doctor');
    }
}