<?php

namespace App\Http\Controllers;

use Exception;
use App\Mail\SendWelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(){
       try{
        $toMailAddress = 'mokaddes@gmail.com';
        $welcomeMessage = "Hey there! Welcome to our website!";
        $response = Mail::to($toMailAddress)->send(new SendWelcomeMail($welcomeMessage));
        dd($response);

       }
         catch(Exception $e){
              return response()->json(['message' => 'Mail not sent!']);
         }
    }
}
