<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>{{$horse->name}}</title>
        <style>
            @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            src: url({{ asset('fonts/Roboto-Regular.ttf') }});
            }
            @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: bold;
            src: url({{ asset('fonts/Roboto-Bold.ttf') }});
            }
            body {
                font-family: 'Roboto';
            }
        </style>
    </head>
    <body>
        <h1 style="text-align: center;">About horse</h1>
        <h3>Name: {{$horse->name}}</h3>
        <h4>Runs: {{$horse->runs}}, wins: {{$horse->wins}}</h4>
        <div>
            <p>
                {!!$horse->about!!}
            </p>
        </div>
    </body>
</html>