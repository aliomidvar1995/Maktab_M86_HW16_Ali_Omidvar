<?php

namespace controller;

use core\Application;
use core\Controller;
use core\middlewares\AuthMiddleware;
use core\middlewares\PatientMiddleware;
use core\Request;
use core\Response;
use model\Doctor;
use model\Patient;
use model\PatientDoctor;
use PDO;

class PatientController extends Controller
{
    public static function create(Request $request, Response $response)
    {
        AuthMiddleware::execute();
        PatientMiddleware::execute();
        $doctorModel = new Doctor();
        $doctors = $doctorModel->doctors();
        $patientDoctor = new PatientDoctor();
        $patientIndex = $patientDoctor->patientIndex(Application::$app->user->id);
        // var_dump($patientIndex);die();
        $response->renderView('auth', 'patient', [
            'user' => Application::$app->user,
            'doctors' => $doctors,
            'patientIndex' => $patientIndex
        ]);
    }

    public static function store(Request $request, Response $response)
    {
        // var_dump($_POST);die();
        $patient = new Patient();
        $body = $request->getBody();

        // 
        $sql = "SELECT COUNT(visit) FROM doctor_info
        JOIN patient_doctor ON doctor_info.id = patient_doctor.doctor_id
        JOIN patient_info ON patient_info.id = patient_doctor.patient_id
        JOIN users ON users.id = patient_info.patient_id
        WHERE doctor_info.id = :doctor_id AND patient_info.visit = :visit";
        $stmt = $patient->prepare($sql);
        $stmt->execute([
            'doctor_id' => $body['doctor_id'],
            'visit' => $body['visit']
        ]);
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        $countVisit = $count['COUNT(visit)'];
        // 

        // 
        $sql = "SELECT visit, patient_id FROM patient_info";
        $stmt = $patient->prepare($sql);
        $stmt->execute();
        $unique = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(!in_array(['visit' => $body['visit'], 'patient_id' => $body['user_id']], $unique)){
        // 
        // var_dump($countVisit);die();
            if($countVisit < 10) {
                $sql = "INSERT INTO patient_info (visit, patient_id)
                VALUES (:visit, :patient_id)";
                $stmt = $patient->prepare($sql);
                $stmt->execute([
                    'visit' => $body['visit'],
                    'patient_id' => $body['user_id']
                ]);
                // 
                $sql = "SELECT id FROM patient_info ORDER BY id DESC LIMIT 1";
                $stmt = $patient->prepare($sql);
                $stmt->execute();
                $id = $stmt->fetch(PDO::FETCH_ASSOC);
                // 
                $sql = "INSERT INTO patient_doctor (patient_id, doctor_id)
                VALUES (:patient_id, :doctor_id)";
                $stmt = $patient->prepare($sql);
                $stmt->execute([
                    'patient_id' => $id['id'],
                    'doctor_id' => $body['doctor_id']
                ]);
            }
        }
        $response->redirect('/patient');
    }
}