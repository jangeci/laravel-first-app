<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function ChangePassword()
    {
        return view('admin.body.change_password');
    }

    public function PasswordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ], [
            'old_password.required' => 'Old Password is required.',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Password Changed Successfully');
        } else {
            return redirect()->back()->with('error', 'Current Password is Incorrect');
        }
    }

    public function ProfileEdit(Request $request)
    {
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            if ($user) {
                return view('admin.body.update_profile', compact('user'));
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function ProfileUpdate(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($user) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
            ]);

            $user->name = $request['name'];
            $user->email = $request['email'];

            $user->save();
            return redirect()->back()->with('success', 'Profile Updated Successfully');
        }
        return redirect()->back();
    }
}
