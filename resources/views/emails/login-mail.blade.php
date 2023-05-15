<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DSA</title>
</head>

<body>
    @php
        $currentDateTime = now()->tz('Asia/Kolkata');
    @endphp
    <p>Hello Esenceweb Team,</p>
    <p>{{ auth()->user()->firstname . ' ' . auth()->user()->lastname }} Successfully Signed In to Backend and Marked In
    </p>
    <p>Assigned his/her todays task</p>
    <p><strong>Logged in Timestamp:</strong> {{ $currentDateTime }}</p>

    <p style="margin-bottom: 0px">Thanks and Best Regards,</p>
    <p>Esenceweb Team</p>
    <a href="https://www.esenceweb.com/">www.esenceweb.com</a>
</body>

</html>
