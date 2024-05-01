<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function change()
    {
        return view('change.password');
    }   
    public function changepass(Request $request)
    {
        $user = null;
        $validated = $request->validate([
            'email' => 'required|email',
            'current_password' => 'required',
            'password' => 'required',
        ]);
        try {
            $user = Users::where('email', $validated['email'])->first();
            
        } catch (\Exception $e) {
            return redirect()->route('changePassword.change')
            ->with('error', 'Invalid Email!.');
        }
        if ($user && Hash::check($validated['current_password'], $user->password)) {
            $user['password'] = Hash::make($request->input('password'));
            $user->save();

            return redirect()->route('Crud.index')
             ->with('success', 'Post created successfully.');
        } else {
            return redirect()->route('changePassword.change')
            ->with('error', 'Invalid password.');
        }   
    }
}
