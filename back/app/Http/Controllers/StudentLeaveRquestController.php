<?php

namespace App\Http\Controllers;

use App\Models\StudentLeaveRquest;
use Illuminate\Http\Request;

class StudentLeaveRquestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return StudentLeaveRquest:: with('student')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $studentLeaveRequest = new StudentLeaveRquest();
        $studentLeaveRequest->leave_type = $request->leave_type;
        $studentLeaveRequest->start_date = $request->start_date;
        $studentLeaveRequest->end_date = $request->end_date;
        $studentLeaveRequest->duration = $request->duration;
        $studentLeaveRequest->status = "Padding";
        $studentLeaveRequest->reason = $request->reason;
        $studentLeaveRequest->student_id= $request->student_id;
        $studentLeaveRequest->save();
        (new MailController)->requestLeave();

        return response()->json(['message:'=>'create studentLeaveRequest successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentLeaveRquest  $studentLeaveRquest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return StudentLeaveRquest::with('student')->where('id', $id)->get();
    }
    public function getLeaveByStudentId(Request $request,$student_id)
    {
        //
        return StudentLeaveRquest::where('student_id', $student_id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentLeaveRquest  $studentLeaveRquest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $studentLeaveRequest = StudentLeaveRquest::with('student')->findOrFail($id);
        $studentLeaveRequest->status = $request->status;
        $studentLeaveRequest->save();
        (new MailController)->responeLeaveMail($studentLeaveRequest->student);

        return response()->json(['message:'=>"Response student's leave request successfully"]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentLeaveRquest  $studentLeaveRquest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return StudentLeaveRquest::destroy($id);
    }
}
