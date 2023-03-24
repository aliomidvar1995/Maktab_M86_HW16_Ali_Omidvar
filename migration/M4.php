<?php


use core\Application;

class M4
{
    public function up() {
        $db = Application::$app->db;
        $SQL = "CREATE TABLE patient_doctor (
            id INT NOT NULL AUTO_INCREMENT,
            patient_id INT NOT NULL,
            doctor_id INT NOT NULL,
            PRIMARY KEY (id),
            FOREIGN KEY (patient_id) REFERENCES patient_info(id),
            FOREIGN KEY (doctor_id) REFERENCES doctor_info(id)
        );";
        $db->conn->exec($SQL);
    }
    public function down() {
        $db = Application::$app->db;
        $SQL = "DROP TABLE patient_doctor;";
        $db->conn->exec($SQL);
    }
}