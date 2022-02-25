<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Enquiry</title>
</head>
<body>
    <h4>New Enquiry</h4>

    Dear Admin,
    <br><br>
    New Mail From {{ ucfirst($data->customer_name) }},
    <br>
    <br>
    <strong>From:</strong>
    <br>
    <br>
    <strong>Name:</strong> {{ $data->customer_name}}
    <br>
    <strong>Email:</strong> {{ $data->email}}
    <br>
    <strong>Phone:</strong> {{ $data->phone}}
    <br>
    <strong>Subject:</strong> {{ $data->subject}}
    <br>
    <strong>Message:</strong> {{ $data->customer_message}}
</body>
</html>