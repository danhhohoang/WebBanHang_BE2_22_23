<?php

namespace App\Http\Controllers;
use App\Mail\MailMaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{   
    
    public function sendEmail($title, $subject,$body, $email,$name='',$admin=''){
        $format_body = str_replace('{{$email}}',$email, $body);
        $credentials = [
            'title' => $title,
            'subject' => $subject,
            'body' => $format_body,
            'email' => $email
        ];
        Mail::to($email)->send( new MailMaster($credentials));
    }  
}
