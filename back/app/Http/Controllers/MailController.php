<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestLeaveMail;
use App\Mail\responeLeaveMail;
class MailController extends Controller
{
    public function requestLeave($detail){
        Mail::to([$detail->email])->send(new RequestLeaveMail($detail));
    }
    public function responeLeaveMail($detail){
        Mail::to([$detail->email])->send(new responeLeaveMail($detail));
    }
}

