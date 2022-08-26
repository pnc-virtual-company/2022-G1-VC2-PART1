<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
class MailController extends Controller
{
    public function sendEmail(){
        // $username='rady';
        Mail::to(['vansao.hang99@gmail.com',"vansao.vc2@gmail.com"])->send(new SendMail());
    }
}

