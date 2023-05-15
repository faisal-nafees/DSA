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
    <p>Hello {{ auth()->user()->firstname . ' ' . auth()->user()->lastname }},</p>
    <p>Welcome Back, Good Morning!
    </p>
    <p>We saw that you have recently signed in for a Esenceweb IT Backend and we just wanted to send a quick note to
        thank you for your attendance.</p>
    <p>You have successfully logged-in for today attendance and don't forgot to submit your todays reporting to your
        assigned manager also markout system before leave.</p>
    <p>Kindly go through the assigned task if not assign please add your today's task.</p>
    <p style="color: red">Also note that regular, ontime attendance and daily reporting will be mandatory for your
        performace calculation.</p>
    <p>If you have any questions, please don't hesitate to contact us!</p>
    <p style="margin-bottom: 0px">Thanks and Best Regards,</p>
    <p>Esenceweb Team</p>
    <a href="https://www.esenceweb.com/">www.esenceweb.com</a>
</body>

</html>
