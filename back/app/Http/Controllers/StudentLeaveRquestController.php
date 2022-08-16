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
        return StudentLeaveRquest:: get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $request->validate([
        //     'start_date' => [
        //         'required',
        //         'date_format:Y-m-d',    
        // ],
        //     'end_date' => [
        //         'required',
        //         'date_format:Y-m-d',    
        // ],
        //     'reason' => 'required',
           
        //     'request_date' => [
        //         'required',
        //         'date_format:Y-m-d',    
        // ],
        // ]);
        $studentLeaveRequest = new StudentLeaveRquest();
        $studentLeaveRequest->start_date = $request->start_date;
        $studentLeaveRequest->end_date = $request->end_date;
        $studentLeaveRequest->reason = $request->reason;
        $studentLeaveRequest->leave_type = $request->leave_type;
        $studentLeaveRequest->duration = $request->duration;
        $studentLeaveRequest->status = $request->status;
        $studentLeaveRequest->request_date = $request->request_date;
        $studentLeaveRequest->student_id= $request->student_id;
        $studentLeaveRequest->save();
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
        return StudentLeaveRquest::where('id', $id)->get();
        
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
        //
        // $request->validate([
        //     'start_date' => [
        //         'required',
        //         'date_format:mm/dd/yy',    
        // ],
        //     'end_date' => [
        //         'required',
        //         'date_format:mm/dd/yy',    
        // ],
        //     'reason' => 'required',
           
        //     'request_date' => [
        //         'required',
        //         'date_format:mm/dd/yy',    
        // ],
        // ]);
        
        $studentLeaveRequest = StudentLeaveRquest::findOrFail($id);
        $studentLeaveRequest->start_date = $request->start_date;
        $studentLeaveRequest->end_date = $request->end_date;
        $studentLeaveRequest->reason = $request->reason;
        $studentLeaveRequest->leave_type = $request->leave_type;
        $studentLeaveRequest->duration = $request->duration;
        $studentLeaveRequest->status = $request->status;
        $studentLeaveRequest->request_date = $request->request_date;
        $studentLeaveRequest->student_id= $request->student_id;
        $studentLeaveRequest->save();
        return response()->json(['message:'=>'update studentLeaveRequest successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentLeaveRquest  $studentLeaveRquest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return StudentLeaveRquest::destroy($id);
    }
}