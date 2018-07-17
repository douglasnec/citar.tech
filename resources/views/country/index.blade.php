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
    <section>
        <div class='row' style='padding:20px;'>
            <a href='{{ route('country.list') }}'>
                <button type='button' class='btn btn-primary'>Listar do banco</button>
            </a> Até aqui eu havia feito no banco; Fica ai para incrementar
        </div>
        <div class='row' style='padding:20px;'>
            <a href='{{ route('country.list-file', ['file' => 'country.txt']) }}'>
                <button type='button' class='btn btn-success'>Listar do arquivo</button>
            </a>
        </div>
        <div class='row' style='padding:20px;'>
            <a href='{{ route('country.download', ['file' => 'country.txt']) }}'>
                <button type='button' class='btn btn-info'>Baixar Csv</button>
            </a>
        </div>
        <div class='row' style='padding:20px;'>
            <a href='{{ route('country.excel', ['file' => 'country.txt']) }}'>
                <button type='button' class='btn btn-default'>Baixar Excel</button>
            </a>
        </div>
    </section>
    <section>Projeto teste de Douglas Nery de Carvalho</section>
</body>
</html>