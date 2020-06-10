<?php

namespace App\Http\Controllers\PhoneNumber;

use App\Http\Controllers\Controller;

use App\Http\Requests\Model\PhoneNumberRequest;
use App\Http\Requests\Update\PhoneNumberUpdateRequest;

use App\PhoneNumber;
use App\Role as R;

use Illuminate\Support\Facades\Auth;

class PhoneNumberController extends Controller
{
    /**
     * @param PhoneNumberRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(PhoneNumberRequest $request)
    {
        $phoneNumbers = $this->getPhoneNumbers();
        return response()->json($phoneNumbers);
    }

    /**
     * @param PhoneNumberRequest $request
     * @param PhoneNumber $phoneNumber
     */
    public function show(PhoneNumberRequest $request, PhoneNumber $phoneNumber)
    {
        return response()->json($phoneNumber);
    }

    /**
     * @param PhoneNumberUpdateRequest $request
     */
    public function create(PhoneNumberUpdateRequest $request)
    {
        PhoneNumber::create($request->validated());

        $phoneNumbers = $this->getPhoneNumbers();
        return response()->json($phoneNumbers);
    }

    /**
     * @param PhoneNumberUpdateRequest $request
     * @param PhoneNumber $phoneNumber
     */
    public function update(PhoneNumberUpdateRequest $request, PhoneNumber $phoneNumber)
    {
        $phoneNumber->update($request->validated());

        $phoneNumbers = $this->getPhoneNumbers();
        return response()->json($phoneNumbers);
    }

    /**
     * @param PhoneNumberUpdateRequest $request
     * @param PhoneNumber $phoneNumber
     */
    public function delete(PhoneNumberUpdateRequest $request, PhoneNumber $phoneNumber)
    {
        $phoneNumber->delete();

        $phoneNumbers = $this->getPhoneNumbers();
        return response()->json($phoneNumbers);
    }

    public function getPhoneNumbers(){

        $phoneNumberQuery = PhoneNumber::query();

        if( Auth::user()->hasRole([R::BUSINESS]) )
        {
            $phoneNumberQuery->where('business_id', Auth::user()->business_id);

        }elseif(Auth::user()->hasRole([R::ADMIN])){
            //UNUSED FOR NOW
        }

        return $phoneNumberQuery->get();
    }
}
