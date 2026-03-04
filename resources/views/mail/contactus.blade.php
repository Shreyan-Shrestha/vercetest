<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Message Received</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <h1>Received Message:</h1>
        <p>From: {{ $contact['firstname'] }} Last Name: {{ $contact['lastname'] }}</p>
        <p>Email: {{ $contact['email'] }}</p>
        <p>Subject: {{ $contact['subject'] }}</p>
        <p>Message: {{ $contact['message'] }}</p>
    </body>
</html>