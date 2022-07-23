<?php

namespace App\Http\Controllers;

use App\Services\SettingServices;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getRoles(SettingServices $settingServices) {
        
        $roles = $settingServices->getRoles();

        return response()->json($roles, 200);
    }

    public function getInstitutes(SettingServices $settingServices) {
        $institutes = $settingServices->getInstitutes();
        return response()->json($institutes, 200);
    }

    public function getCourses(SettingServices $settingServices) {
        $courses = $settingServices->getCourses();
        return response()->json($courses, 200);
    }
}
