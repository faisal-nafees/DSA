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
    <p>{{ auth()->user()->firstname . ' ' . auth()->user()->lastname }} has submitted reporting</p>
    <p>Kindly check details of reporting</p>
    <p><strong>Task Title:</strong> {{ $dataArray['title'] }}</p>
    <p><strong>Report Description:</strong> {{ $dataArray['report_description'] }}</p>
    <p><strong>Report Attachment:</strong>
        @if ($dataArray['attachment'])
            <a href="{{ url('/') . '/storage/' . $dataArray['attachment'] }}">Attachment</a>
        @else
            <span>No Attachment</span>
        @endif
    </p>
    <p><strong>Report Date:</strong> {{ $dataArray['report_date'] }}</p>
    <p><strong>Report Start:</strong> {{ $dataArray['start_task'] }}</p>
    <p><strong>Report End:</strong> {{ $dataArray['end_task'] }}</p>
    <p><strong>Report Status:</strong> {{ $dataArray['status_name'] }}</p>
    <p style="margin-bottom: 0px">Thanks and Best Regards,</p>
    <p>Esenceweb Team</p>
    <a href="https://www.esenceweb.com/">www.esenceweb.com</a>
</body>

</html>
