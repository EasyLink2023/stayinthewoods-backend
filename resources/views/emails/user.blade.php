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
            <p>Hello {{ $form->first_name . $form->last_name }},</p>
            <p> Thank you for showing interest in the services offered by The Woodlands Inn!</p>

            <p>We will contact you at the earliest. Alternatively, you can also check out our Website for more services.
            </p>
            <p>Feel free to reach out to us:
            </p>
            <p>Phone: 570-824-9831
            </p>
            <p>Email: sales@thewoodlandsresort.com
            </p>
            <p>We would be delighted if you could follow us on our social platforms:
            </p>
            <p>
                Thanks for your inquiry

                Team The Woodlands Inn
            </p>
        </div>
        <div class="email-footer">
            <p>&copy; 2024 The Woodlands Inn . All rights reserved.</p>
        </div>
    </div>
</body>

</html>
