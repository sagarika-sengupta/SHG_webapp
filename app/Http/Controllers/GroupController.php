<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function addUserToGroup(Request $request)
    {
        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Check if there's an existing group for the user's village with less than 10 users
        $group = Group::where('village', $user->village)
            ->where('user_count', '<', 10)
            ->first();

        if (!$group) {
            // Create a new group if no suitable group exists
            $group = Group::create([
                'group_id' => 'GRP' . strtoupper(uniqid()),
                'village' => $user->village,
                'district' => $user->district,
                'state' => $user->state,
                'user_count' => 0,
            ]);
        }

        // Add the user to the group
        $group->users()->attach($user->id);

        // Increment the user count for the group
        $group->increment('user_count');

        return response()->json(['message' => 'User added to group successfully', 'group_id' => $group->group_id]);
    }
}
