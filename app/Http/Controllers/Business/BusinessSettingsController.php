<?php

namespace App\Http\Controllers\Business;

use App\Business;
use App\Http\Requests\Model\BusinessRequest;
use App\Http\Controllers\BaseController;

use App\Http\Requests\Update\BusinessUpdateRequest;

class BusinessSettingsController extends BaseController
{

    public function index(BusinessRequest $request){

        \Log::info("Should not be using this.");

        //if($request->json){
            //return SettingsBusiness::all();
        //}

        //return view('settings-businesss', ' Settings Business', [], []);
    }

    public function show(Business $business, BusinessRequest $request){

        $business->load('addresses', 'phone_numbers', 'responsibleAgent', 'users');

        return view('business.settings_business', ['business' => $business]);

    }

    public function create(BusinessUpdateRequest $request){

    }

    public function update(Business $business, BusinessRequest $request){

    }

    public function delete(Business $business, BusinessRequest $request){

        //$business->delete();

    }
}
