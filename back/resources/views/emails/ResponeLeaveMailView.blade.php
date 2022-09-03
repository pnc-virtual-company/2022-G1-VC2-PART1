<!DOCTYPE html>
<html>
<head>
    <title>PNC SLMS</title>
</head>
<style>

</style>
<body>
    <?php

$status = strtolower($details['status']);
$student = $details['student'];
$firstname = $student['firstname'];
?>
    <p>Dear {{$firstname}},</p>
    <p>The leave request you have applied for period {{$start_date}} to {{$end_date}} has been <strong>{{$status}}</strong>.</p>
    <p>To view further information on this responding, please click the following link and log in to your account.</p>
    <a href="http://localhost:8080/" style="font-weight: bold;">PNC SLMS</a>
    <P>Regards,</P>
    <i>PNC SLMS</i>
</body>
</html>
