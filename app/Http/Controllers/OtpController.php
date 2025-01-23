<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
class OtpController extends Controller
{
 public function sendOtp(Request $request)
 {
 $email = $request->input(‘email’);
 $otp = rand(100000, 999999); // Generate a 6-digit OTP
 // Store OTP in Redis with a 5-minute expiration
 Redis::setex(“otp:$email”, 300, $otp);
 // Send OTP by email
 Mail::to($email)->send(new OtpMail($otp));
 return response()->json([‘message’ => ‘OTP sent successfully’]);
 }
}
