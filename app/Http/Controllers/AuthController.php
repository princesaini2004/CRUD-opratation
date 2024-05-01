<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Request\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;

class AuthController extends Controller
{
    public function login()
    {
        return view('Auth.login');
    }
    public function loginByAuth(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = Users::where('email', $validated['email'])->first();
    
        if (!$user) {
            return redirect()->route('Crud.create')->with('error', 'Invalid Email!.');
        }
    
        if (Hash::check($validated['password'], $user->password)) {
            // Password is correct
            return redirect()->route('Crud.index')->with('success', 'Logged in successfully.');
        } else {
            // Password is incorrect
            return redirect()->route('Auth.login')->with('error', 'Invalid password.');
        }
    }
    // public function loginByAuth(Request $request)
    // {
    //     $user = null;
    //     $validated = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     try {
    //         $user = Users::where('email', $validated['email'])->first();
            
    //     } catch (Exception $e) {
    //         return redirect()->route('Crud.index')
    //         ->with('error', 'Invalid Email!.');
    //     }
        
    //     if ($user && Hash::check($validated['password'], $user->password)) {
    //         return redirect()->route('Crud.index');
    //         // ->with('success', 'Post created successfully.');
    //     } else {
    //         return redirect()->route('Crud.create')
    //         ->with('error', 'Invalid password.');
    //     }        
    // }
}
