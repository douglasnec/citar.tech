<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Teste Citar.Tech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="app.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <script src="app.js"></script>
</head>
<body>
    <p>This list obtained from</p>
    <p>http://www.ics.uci.edu/pub/websoft/wwwstat/country-codes.txt</p>
    <br>
    @foreach($countries as $country)
        <div class='row'>
            <div class='col-md-1'>{{ $country->initial }}</div>
            <div class='col-md-3'>{{ $country->name }}</div>
            <div class='col-md-3'>({{ $country->initial}}) {{ $country->name }}</div>
        </div>
    @endforeach
</body>
</html>