<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{url('assets/css/admin.template.css')}}"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    
    <nav>
        <div class="nav__top">
            <a href="{{url('/')}}">
                <img src="{{url('assets/images/add.png')}}"/>
                Adicionar 
            </a>
            <a href="{{url('/lista')}}">
                <img src="{{url('assets/images/clipboard.png')}}"/>
                Lista Veículos
            </a>
        </div>
        <div class="nav__bottom">
            <a href="{{url('/logout')}}">
                <img src="{{url('assets/images/logout.png')}}"/>
                Logout
            </a>
        </div>
    </nav>
    <section class="container">
        @yield('content')
    </section>
</body>
</html>