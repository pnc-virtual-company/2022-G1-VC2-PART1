<?php

namespace App\Http\Controllers;

use App\Models\StudentLeaveRquest;
use \App\Mail\ResponseLeave;
use \Carbon\Carbon;

class MailController extends Controller
{

    public function responeLeave($leave_id)
    {
        $details = StudentLeaveRquest::with('student')->findOrFail($leave_id);
        $start_date = Carbon::parse($details->start_date)->isoFormat('MMM Do YYYY');
        $end_date = Carbon::parse($details->end_date)->isoFormat('MMM Do YYYY');
        \Mail::to("vansao.hang@student.passerellesnumeriques.org")->send(new ResponseLeave($details,$start_date,$end_date));
        return $details;
    }

}
