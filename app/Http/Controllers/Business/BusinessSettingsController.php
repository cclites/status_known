<?php

namespace App\Http\Controllers\Business;

use App\Business;
use App\Http\Requests\Model\BusinessRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



use App\Http\Requests\BusinessUpdateRequest;

class BusinessSettingsController extends Controller
{

    public function index(BusinessRequest $request){

        //if($request->json){
            //return SettingsBusiness::all();
        //}

        return view('settings-businesss', ' Settings Business', [], []);
    }

    public function show(Business $business, BusinessRequest $request){

        //\Log::Info("Business settings controller");

        $business->load('addresses', 'phone_numbers', 'responsibleAgent', 'users');

        //\Log::info(json_encode($business));


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
