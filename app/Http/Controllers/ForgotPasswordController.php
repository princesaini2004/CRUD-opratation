<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\otp;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class ForgotPasswordController extends Controller
{
    public function forgot()
    {
        return view('forgot.forgot');
    }
    public function forgotpass(Request $request,)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns',
        ]);
        $user = Users::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Email address not found.');
        }
        try {
            $otp = mt_rand(100000, 999999);
            Mail::to($request->email)->send(new ForgotPasswordMail($user, $otp));
            $this->otpstore($user->id, $otp);
            return redirect()->route('forgot.otpVerify', ['id' => $user->id])->with('success', 'Password reset email sent successfully.');


        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send password reset email. Please try again later.');
        }
    }
    public function otpstore($userId, $otp)
    {
        $expiredAt = Carbon::now()->addMinutes(5);
        otp::create([
            'UserId' => $userId,
            'Otp' => $otp,
            'ExpiredAt' => $expiredAt,
            'CreatedAt' => Carbon::now(),
        ]);
        return true;
    }
   
    public function OtpTemplate()
    {
        return view('forgot.OtpTemplate');
    }
    public function otpVerify($id)
    {
        $data=compact('id');
        return view('forgot.otpVerify')->with($data);
    }
    public function Verifyotp(Request $request)
    {

        $request->validate([
            'userId' => 'required',
            'otp' => 'required',
        ]);
       
        $otp = $request->otp;
        $userId = $request->userId;
        
    
        try {
            $otpData = otp::where('otp', $otp)
        ->where('userid', $userId)
        ->where('ExpiredAt', '>=', now())
        ->first();
    
        if (!$otpData) {
            return redirect()->back()->with('error', 'Incorrect or expired OTP.');
        }
            return redirect()->route('forgot.changeforgot',['id' => $userId])->with('success', 'OTP verified successfully.');
        } catch (\Exception $e) {
            return redirect()->route('Crud.index')->with('error', 'An unexpected error occurred.');
        }
    }
    public function changeforgot($id)
    {
        $data=compact('id');
        return view('forgot.changeforgot')->with($data);
    }
    public function changeforgotpass(Request $request)
    {
        $validated = $request->validate([
            'userId' =>'required' ,
            'password' => 'required',
        ]);
        $userId = $request->userId;
        try {
            $user = Users::where('id', $validated['userId'])->first();
            
        } catch (\Exception $e) {
            return redirect()->route('forgot.changeforgotpass')
            ->with('error', 'Invalid Email!.');
        }
        if ($user) {
            $user['password'] = Hash::make($request->input('password'));
            $user->save();

            return redirect()->route('Auth.login')
             ->with('success', 'Post created successfully.');
        } else {
            return redirect()->route('forgot.changeforgotpass')
            ->with('error', 'Invalid password.');
        }   
    }
}
