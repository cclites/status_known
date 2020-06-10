<?php

namespace App\Http\Controllers\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\Model\AddressRequest;
use App\Http\Requests\Update\AddressUpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Address;
use App\Permission as P;
use App\Role as R;
use function App\Reports\query;

class AddressController extends Controller
{

    /**
     * @param AddressRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(AddressRequest $request)
    {
        $addresses = $this->getAddresses();
        return response()->json($addresses);
    }

    /**
     * @param AddressRequest $request
     * @param Address $address
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(AddressRequest $request, Address $address)
    {
        return response()->json($address);
    }

    /**
     * @param AddressUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(AddressUpdateRequest $request)
    {
        Address::create($request->toArray());

        $addresses = $this->getAddresses();
        return response()->json($addresses);
    }

    /**
     * @param AddressUpdateRequest $request
     * @param Address $address
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AddressUpdateRequest $request, Address $address)
    {
        $address->update($request->toArray());

        $addresses = $this->getAddresses();
        return response()->json($addresses);
    }

    /**
     * @param AddressUpdateRequest $request
     * @param Address $address
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(AddressUpdateRequest $request, Address $address)
    {
        $address->delete();

        $addresses = $this->getAddresses();
        return response()->json($addresses);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAddresses()
    {
        $addressesQuery = Address::query();

        if( Auth::user()->hasRole([R::BUSINESS]) ){
            $addressesQuery->where('business_id', Auth::user()->business_id);
        }

        return $addressesQuery->get();
    }
}
