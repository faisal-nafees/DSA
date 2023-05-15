<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DSA</title>
</head>

<body>
    <p>Hi Esenceweb Team,</p>
    <p>{{ $dataArray['fullname'] }} has shown interest in {{ $dataArray['interest'] }} </p>
    <p><strong>Mobile:</strong> <a href="tel:{{ $dataArray['primary_mobile'] }}">{{ $dataArray['primary_mobile'] }}</a>
    </p>
    <p><strong>Email id:</strong> <a href="mailto:{{ $dataArray['email'] }}">{{ $dataArray['email'] }}</a></p>
    <p><strong>Message:</strong> {{ $dataArray['additional_info'] }}</p>
    <p>Kindly check the details of the user</p>
    <p style="margin-bottom: 0px">Thanks and Best Regards,</p>
    <p>Esenceweb Team</p>
    <a href="https://www.esenceweb.com/">www.esenceweb.com</a>
</body>

</html>
