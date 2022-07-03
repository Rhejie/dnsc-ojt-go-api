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
}
