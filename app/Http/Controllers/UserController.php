<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('users.index');
    }
    public function profile(Request $request)
    {
        $user = $request->user();
        $user['image'] = 'https://eagleeyeapp.000webhostapp.com/users/' . $user->image;
        return response()->json([
            'state' => true,
            'data' => $user,
        ], 200);
    }
    public function updateProfile(Request $request)
    {
        $input = $request->all();
        $user = $request->user();
        $user->update($input);
        return response()->json([
            'state' => true,
            'data' => $user,
        ], 200);
    }
    public function updateProfileImage(Request $request)
    {
        $input = $request->all();
        $user = $request->user();
        if (isset($user->image)) {
            $file = $request->file('image');
            $imageName = $user->image;
            $file->move("users/", $imageName);
            $input['image'] = $imageName;
        } else {
            $file = $request->file('image');
            $ext = $file->extension();
            $imageName = uniqid() . "." . $ext;
            $file->move("users/", $imageName);
            $input['image'] = $imageName;
        }
        $user->update($input);
        return response()->json([
            'state' => true,
            'data' => $user,
        ], 200);
    }

}
