<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <style>
        #map {
            height: 0;
            width: 100%;
            padding-bottom: 60%;
            /* Rasio aspek yang diinginkan (contoh 60% untuk rasio 3:2) */
        }

        .percentage-container {
            transition: width 0.5s ease-in-out;
            /* Adjust the transition properties as needed */
        }

        .cell-container {
            display: flex;
        }
    </style>
    @vite('resources/css/app.css')
</head>

<body>
