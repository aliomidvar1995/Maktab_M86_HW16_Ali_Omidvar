<?php

namespace model;

use core\Application;
use core\Model;
use PDO;

class Doctor extends Model {
    const TABLE_NAME = 'doctor_info';
    const PRIMARY_KEY = 'id';
    public string $image = '';
    public string $expertise = '';
    public $saturday = '';
    public $sunday = '';
    public $monday = '';
    public $tuesday = '';
    public $wednesday = '';
    public $thursday = '';
    public $friday = '';
    public $doctor_id;

    public function attributes(): array {
        return ['image', 'expertise', 'saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'doctor_id'];
    }

    // public function index($expertise) {
    //     $SQL = "SELECT * FROM users
    //     JOIN doctor_info ON users.id = doctor_info.user_id
    //     WHERE expertise = :expertise";
    //     $statement = $this->prepare($SQL);
    //     $statement->execute([
    //         'expertise' => $expertise
    //     ]);
    //     $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }

    public function completed($doctor_id) {
        $SQL = "SELECT * FROM users
        JOIN doctor_info ON users.id = doctor_info.doctor_id
        WHERE doctor_id = :doctor_id";
        $statement = $this->prepare($SQL);
        $statement->execute([
            'doctor_id' => $doctor_id
        ]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function index($expertise) {
        $SQL = "SELECT * FROM users
        JOIN doctor_info ON users.id = doctor_info.doctor_id
        WHERE expertise = :expertise";
        $statement = $this->prepare($SQL);
        $statement->execute([
            'expertise' => $expertise
        ]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function doctors() {
        $SQL = "SELECT * FROM users
        JOIN doctor_info ON users.id = doctor_info.doctor_id";
        $statement = $this->prepare($SQL);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function nameSearch($name) {
        $SQL = "SELECT * FROM users
        JOIN doctor_info ON users.id = doctor_info.doctor_id
        WHERE name LIKE :name";
        $statement = $this->prepare($SQL);
        $statement->execute([
            'name' => "%$name%"
        ]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function expertiseSearch($expertise) {
        $SQL = "SELECT * FROM users
        JOIN doctor_info ON users.id = doctor_info.doctor_id
        WHERE expertise LIKE :expertise";
        $statement = $this->prepare($SQL);
        $statement->execute([
            'expertise' => "%$expertise%"
        ]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function image() {
        $image = $_FILES['image'];
        $imageArr = explode('.', $image['name']);
        $extension = end($imageArr);
        $imageName = Application::$app->user->id.'.'.$extension;
        move_uploaded_file($image['tmp_name'], '../public/images/'.$imageName);
        $this->image = $imageName;
    }
}