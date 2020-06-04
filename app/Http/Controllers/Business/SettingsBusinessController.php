<?php

namespace App\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Businesss;

use App\Http\Requests\SettingsBusinessRequest;

class SettingsBusinessController extends Controller
{

    public function index(SettingsBusinessRequest $request){

        if($request->json){
            return SettingsBusiness::all();
        }

        return view('settings-businesss', ' Settings Business', [], []);
    }

    public function show(SettingsBusinessRequest $request, SettingsBusiness $settings){
        return $settings;
    }

    public function create(SettingsBusinessUpdateRequest $request){

    }

    public function update(SettingsBusinessUpdateRequest $request, SettingsBusiness $settings){

    }

    public function delete(SettingsBusinessUpdateRequest $request, SettingsBusiness $settings){
        $settings->delete();
    }
}
