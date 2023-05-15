<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DSA</title>
</head>

<body>
    @if ($dataArray['user_id'] == auth()->user()->user_id)
        <p>Hello {{ auth()->user()->firstname . ' ' . auth()->user()->lastname }},</p>
        <p>You have added a new task in portal please do submit report on the same task once your task finished.</p>
    @else
        <p>Hello,</p>
        <p>Kindly check the details of new task which is assign to you.</p>
    @endif
    <p style="margin-bottom: 0px">Thanks and Best Regards,</p>
    <p>Esenceweb Team</p>
    <a href="https://www.esenceweb.com/">www.esenceweb.com</a>
</body>

</html>
