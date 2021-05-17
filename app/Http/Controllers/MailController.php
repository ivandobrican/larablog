<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MailController extends Controller
{
    public function contact(){
        return view('mail.contact');
    }

    public function send(Request $request){
        $data = [
          'name' =>$request->name,
            'email' =>$request->email,
            'subject' =>$request->subject,
            'mail_message' =>$request->mail_message,
        ];
        Mail::send('mail.send',$data,function($message){
            $message->to('ivandobrican@gmail.com','Ivan')->subject('Mail received from larablog');
        });
        Session::flash('success_mail_message','You have successfully sent an email :)');
        return redirect('/');
    }
}
