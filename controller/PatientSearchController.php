<?php

namespace controller;

use core\Application;
use core\Controller;
use core\Request;
use core\Response;
use model\Doctor;
use model\PatientDoctor;

class PatientSearchController extends Controller
{
    public static function index(Request $request, Response $response)
    {
        $patientDoctor = new PatientDoctor();
        $patientIndex = $patientDoctor->patientIndex(Application::$app->user->id);
        $doctorModel = new Doctor();
        if(isset($request->getBody()['search']) && $request->getBody()['search'] === 'name'){
            $doctors = $doctorModel->nameSearch($request->getBody()['text']);
        }
        if(isset($request->getBody()['search']) && $request->getBody()['search'] === 'expertise') {
            $doctors = $doctorModel->expertiseSearch($request->getBody()['text']);
        }
        $response->renderView('auth', 'patient', [
            'user' => Application::$app->user,
            'doctors' => $doctors,
            'patientIndex' => $patientIndex
        ]);
    }
}