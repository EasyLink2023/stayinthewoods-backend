<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
        }

        .email-header,
        .email-footer {
            background-color: #3f1324;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }

        .email-body {
            padding: 20px;
        }

        .email-footer p {
            margin: 0;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>The Woodlands Inn</h1>
        </div>
        <div class="email-body">
            <h1>New {{ $form->page_name }} Request </h1>
            <p>First Name: {{ $form->first_name ?? 'N/A' }}</p>
            <p>Last Name: {{ $form->last_name ?? 'N/A' }}</p>
            <p>Email: {{ $form->email ?? 'N/A' }}</p>
            <p>Phone: {{ $form->phone ?? 'N/A' }}</p>
            <p>Contact Method: {{ $form->contact_method ?? 'N/A' }}</p>
            <p>Type of Reunion: {{ $form->type_reunion ?? 'N/A' }}</p>
            <p>When is the Event: {{ $form->when_is_the_event ?? 'N/A' }}</p>
            <p>How Many Guests: {{ $form->how_many_guests ?? 'N/A' }}</p>
            <p>More Info: {{ $form->more_info ?? 'N/A' }}</p>
            <p>Page Name: {{ $form->page_name ?? 'N/A' }}</p>
        </div>
        <div class="email-footer">
            <p>&copy; 2024 The Woodlands Inn. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
