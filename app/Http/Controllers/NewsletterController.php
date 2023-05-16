<?php

namespace App\Http\Controllers;

use App\Mail\MailMaster;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function sendMail($title, $object,$body, $email){
        $credentials = [
            'title' => $title,
            'subject' => $object,
            'body' => $body,
            'email' => $email
        ];
        Mail::to($email)->send( new MailMaster($credentials));
    }
    public function storeEmail(Request $request){
        Newsletter::create($request->email);
    }
}
