<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DSA</title>
</head>

<body>
    <p>Hello Esenceweb Team,</p>
    <p>{{ auth()->user()->firstname . ' ' . auth()->user()->lastname }} added a new task from portal</p>
    <p><strong>Task Title:</strong> {{ $dataArray['title'] }}</p>
    <p><strong>Task Description:</strong> {{ $dataArray['description'] }}</p>
    <p><strong>Assign Datetime:</strong> {{ $dataArray['assigned_date'] . ',' . $dataArray['assigned_time'] }}</p>
    <p><strong>Estimate Datetime:</strong> {{ $dataArray['estimate_date'] . ',' . $dataArray['estimate_time'] }}</p>
    <p><strong>Attachment:</strong>
        @if ($dataArray['attachment_1'])
            <a href="{{ url('/') . '/storage/' . $dataArray['attachment_1'] }}">Attachment 1</a>
        @endif
        @if ($dataArray['attachment_2'])
            <a href="{{ url('/') . '/storage/' . $dataArray['attachment_2'] }}">Attachment 2</a>
        @endif
    </p>
    <p style="margin-bottom: 0px">Thanks and Best Regards,</p>
    <p>Esenceweb Team</p>
    <a href="https://www.esenceweb.com/">www.esenceweb.com</a>
</body>

</html>
