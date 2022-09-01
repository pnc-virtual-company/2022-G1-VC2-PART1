<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestLeaveMail;
use App\Mail\responeLeaveMail;

class MailController extends Controller
{
    public function requestLeave()
    {
        Mail::to("samoulvann@gmail.com")->send(new RequestLeaveMail());
    }
    public function responeLeaveMail($detail)
    {
        Mail::to([$detail->email])->send(new responeLeaveMail($detail));
    }
}
