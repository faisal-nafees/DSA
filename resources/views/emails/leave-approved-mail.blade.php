<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DSA</title>
</head>

<body>
    <p>Dear {{ $username }},</p>
    <p>Your leave request successfully approved by {{ auth()->user()->firstname . ' ' . auth()->user()->lastname }}</p>
    <p style="margin-bottom: 0px">Thanks and Best Regards,</p>
    <p>Esenceweb Team</p>
    <a href="https://www.esenceweb.com/">www.esenceweb.com</a>
</body>

</html>
