<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<h1>Olá {{$content->usuario}},</h1>
<p>Boas vindas!</p>

<p>
    Nós da <b>{{ $content->atletica }}</b> temos o prazer de ter você como sócio. Vamos colocar nossa atlética no topo.
</p>
<p>
    Acesse agora mesmo nosso sistema e veja tudo que temos para você.
</p>

<p>
    <strong>Login:</strong> {{$content->login}}
    <br>
    @if($content->password)<strong>Senha:</strong> {{$content->password}} <br>@endif
    <br>
    <a href="{{ env('APP_URL_SITE') }}">
        Acesar o sistema
    </a>
</p>

<p>
    Equipe {{ env('APP_NAME') }}
</p>
</body>
</html>

