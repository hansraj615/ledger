<!DOCTYPE html>
<html>
    <head>
        <title>403 - Access Denied .</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-weight: bold;
                font-family: 'Lato', sans-serif;
                color: #001f3f;
                font-size: 72px;
                margin-bottom: 40px;
            }
            .eno {
                font-weight: bold;
                font-family: 'Lato', sans-serif;
              color: #ed1f24;
              font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Access Denied Error <span class="eno">403</span></div>
                <div><h3>The requested resource requires an authentication.</h3></div>
                <div><a href="{{ URL::previous() }}" ><button class="btn btn-success">Go Back</button></a></div>
            </div>
        </div>
    </body>
</html>
