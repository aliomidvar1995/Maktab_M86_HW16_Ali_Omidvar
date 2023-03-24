<?php

namespace model;

use core\Model;

class Patient extends Model
{
    public function show()
    {
        $sql = "SELECT patient_info.id FROM users
        JOIN patient_info ON users.id = patient_info.patient_id
        WHERE ";
    }
}