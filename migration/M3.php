<?php


use core\Application;

class M3 {

    public function up() {
        $db = Application::$app->db;
        $SQL = "CREATE TABLE patient_info (
            id INT NOT NULL AUTO_INCREMENT,
            visit VARCHAR(255) NOT NULL,
            patient_id INT NOT NULL,
            PRIMARY KEY (id),
            FOREIGN KEY (patient_id) REFERENCES users(id)
        );";
        $db->conn->exec($SQL);
    }
    public function down() {
        $db = Application::$app->db;
        $SQL = "DROP TABLE patient_info;";
        $db->conn->exec($SQL);
    }
}