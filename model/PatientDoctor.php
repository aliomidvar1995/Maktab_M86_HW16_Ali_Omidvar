<?php 

namespace model;
use core\Model;
use PDO;

class PatientDoctor extends Model{
    public function patientIndex($patient_id)
    {
        $sql = "SELECT DISTINCT visit, name, expertise FROM patient_info
        JOIN patient_doctor ON patient_info.id = patient_doctor.patient_id
        JOIN doctor_info ON patient_doctor.doctor_id = doctor_info.id
        JOIN users ON doctor_info.doctor_id = users.id
        WHERE patient_info.patient_id = :patient_id";
        $stmt = $this->prepare($sql);
        $stmt->execute([
            'patient_id' => $patient_id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function doctorIndex($doctor_id)
    {
        $sql = "SELECT * FROM doctor_info
        JOIN patient_doctor ON doctor_info.id = patient_doctor.doctor_id
        JOIN patient_info ON patient_info.id = patient_doctor.patient_id
        JOIN users ON users.id = patient_info.patient_id
        WHERE doctor_info.doctor_id = :doctor_id";
        $stmt = $this->prepare($sql);
        $stmt->execute([
            'doctor_id' => $doctor_id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}