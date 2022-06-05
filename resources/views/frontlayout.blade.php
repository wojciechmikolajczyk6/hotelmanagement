<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Home page</title>
    <script type="text/javascript" src="/vendor/jquery/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
            crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>


{{--    navbar--}}

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Hotel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link " aria-current="page" href="/services">Usługi</a>
                <a class="nav-link" href="/galery">Galeria</a>
            @if(Session::has('customerLogin'))
                    <a class="nav-link" href="/profile/{{Session('data')[0]->id}}">Profil</a>
                    <a class="nav-link" href="/logout">Wyloguj się</a>
                    <a class="nav-link btn btn-success" href="/booking">Rezerwacja pokoju</a>
                @else
                    <a class="nav-link" href="/login">Logowanie</a>
                    <a class="nav-link" href="/register">Rejestracja</a>
                    <a class="nav-link btn btn-success" href="/booking">Rezerwacja</a>
                @endif



            </div>
        </div>
    </div>
</nav>

{{--navbar ends--}}

@yield('content')

@yield('scripts')

<link rel="stylesheet" type="text/css" href="/vendor/lightbox2-2.11.3/dist/css/lightbox.min.css">
<script type="text/javascript" src="/vendor/lightbox2-2.11.3/dist/js/lightbox.min.js"></script>

<style>
    .hide {
        display: none;
    }
</style>
</body>
</html>


