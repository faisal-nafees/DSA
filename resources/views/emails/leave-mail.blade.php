<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DSA</title>
</head>

<body>
    <p>Hello Esenceweb HR,</p>
    <p>{{ auth()->user()->firstname . ' ' . auth()->user()->lastname }} requested for a leave</p>
    <p>Leave Type: {{ $dataArray['type'] }}</p>
    <p>Leave Subject: {{ $dataArray['subject'] }}</p>
    <p>Leave Reason: {{ $dataArray['reason'] }}</p>
    <p>Starts From: {{ $dataArray['leave_start'] }}</p>
    <p>Ends To: {{ $dataArray['leave_end'] }}</p>
    <p style="margin-bottom: 0px">Thanks and Best Regards,</p>
    <p>Esenceweb Team</p>
    <a href="https://www.esenceweb.com/">www.esenceweb.com</a>
</body>

</html>
