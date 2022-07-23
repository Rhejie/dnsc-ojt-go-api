<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Institute;
use App\Models\Role;

class SettingServices {

    public function getRoles() {

        $roles = Role::get();

        return $roles;
    }

    public function getInstitutes() {
        $institutes = Institute::get();

        return $institutes;
    }

    public function getCourses() {
        $courses = Course::get();
        return $courses;
    }

    
    
}