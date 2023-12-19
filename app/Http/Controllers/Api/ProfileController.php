<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = $request->input('name');

        $profiles = $name ? UserProfile::where('name', $name)->get() : UserProfile::all();

        return response()->json([
            'success' => true,
            'message' => 'User profiles retrieved successfully',
            'data' => $profiles
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)
    {
        $user = UserProfile::create($request->validated());

        if(!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user profile',
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'success' => true,
            'message' => 'User Profile created successfully',
            'data' => $user
        ], Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProfile $user_profile)
    {

        if($user_profile) {         
            return response()->json([
                'success' => true,
                'data' => $user_profile,],Response::HTTP_OK);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, UserProfile $user_profile)
    {
        $user_profile_data = $user_profile->update($request->all());

        if(!$user_profile_data){
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user profile',
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'success' => true,
            'message' => 'User Profile updated successfully',
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $user_profile)
    {
        $user = $user_profile->destroy($user_profile);
        return response()->json([
            'success' => true,
            'message' => 'User profile Deleted'],Response::HTTP_OK);
    }
}
