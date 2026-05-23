<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    // GET /api/leaderboard
    public function index()
    {
        $users = User::orderBy('bounty', 'desc')
            ->get(['id', 'name', 'blacklist_rank', 'bounty', 
                   'signature_car', 'territory', 'race_specialty', 
                   'cars_owned', 'avatar']);

        return response()->json($users);
    }

    // GET /api/my-profile
    public function myProfile(Request $request)
    {
        return response()->json($request->user());
    }

    // PUT /api/my-profile
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $user->update($request->only([
            'bounty',
            'signature_car',
            'territory',
            'race_specialty',
            'cars_owned',
        ]));

        return response()->json([
            'message' => 'Profile updated successfully',
            'user'    => $user
        ]);
    }

    // GET /api/leaderboard/{id}
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }
}