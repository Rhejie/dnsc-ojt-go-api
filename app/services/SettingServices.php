<?php

namespace App\Services;

use App\Models\Institute;
use App\Models\Role;

class SettingServices {

    public function getRoles() {

        $roles = Role::get();

        return $roles;
    }
    
}