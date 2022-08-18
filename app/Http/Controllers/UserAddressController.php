<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserAddressRequest;
use App\Http\Requests\UpdateUserAddressRequest;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $userAddresses = UserAddress::where('user_id', auth()->id())->get();
        return response()->json($userAddresses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserAddressRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserAddressRequest $request)
    {
        $userAddress = UserAddress::create($request->validated());
        return response()->json($userAddress);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return UserAddress
     */
    public function show(UserAddress $address)
    {
        return $address;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserAddressRequest  $request
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserAddressRequest $request, UserAddress $address)
    {
        $address->update($request->validated());
        return response()->json($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(UserAddress $address)
    {
        // delete address if exists
        if ($address->exists) {
            $address->delete();
        }
        return response()->json(['message' => 'Address deleted']);
    }
}
