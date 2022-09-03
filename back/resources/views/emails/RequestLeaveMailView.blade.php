<!DOCTYPE html>
<html>
<head>
	<title>REQUEST LEAVE</title>
</head>
<body>
<?php

$status = $details['status'];
$reason = $details['reason'];
$student = $details['student'];
$leave_type = $details['leave_type'];
$duration = $details['duration'];
$firstname = $student['firstname'];
$lastname = $student['lastname'];
?>
	<p>Dear Teacher,</p>
	<p>{{$firstname}} {{$lastname}} has submitted a leave request in <strong>SLMS</strong>. The details of request are as follows:</p>
	<p><strong style="font-weight:600">Leave type</strong> : {{$leave_type}}</p>
	<p><strong style="font-weight:600">Reason</strong>     : {{$reason}}</p>
	<p><strong style="font-weight:600">Leave Date</strong> : From {{$start_date}} to {{$end_date}}</p>
	<p><strong style="font-weight:600">Duration</strong>   : {{$duration}}</p>
	<p>To view further information on this request, and to approve or reject it, please clink the following link:</p>
	<a href="http://localhost:8080/" style="font-weight: bold;">PNC SLMS</a>
    <P>Regards,</P>
    <i>PNC SLMS</i>
</body>
</html>
