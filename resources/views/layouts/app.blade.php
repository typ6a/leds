<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Светодиодное освещение</title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: sans-serif;
        }

        .fa-btn {
            margin-right: 6px;
        }

        .affix {
            top: 0;
            width: 100%;
        }

        .affix + .container-fluid {
            padding-top: 70px;
        }
    </style>
</head>

<body id="app-layout">
<div class="container" style="background-color:#111111;color:#fff;height:200px; overflow: hidden; text-align: left">
    <div style="float: left; width: 75%; height: 200px;">
        <a href="/" style="display: block;
    height: 100%;
    width: 100%;
    background: transparent url(/data/light-08.jpg) no-repeat left 55%;
    background-size: 100%;">

        </a>
    </div>
    <div style="float: right; width:25%">
        <h3>Светодиодное освещение</h3>
        <h4>Оптом и в розницу</h4>
        <h3>Изготовление, монтаж, комплексные проекты</h3>
    </div>
</div>
<nav class="navbar navbar-default" data-spy="affix" data-offset-top="197" role="navigation">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img alt="NEWSUPERLED" src="/data/logo.gif">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">

            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="/about">о нас</a></li>
                <li><a href="/catalog">каталог</a></li>
                <li><a href="/contact">контакы</a></li>

                @if (Auth::check())


                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Админка <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/product/add"><i class="fa fa-btn fa-sign-out"></i>добавить продукт</a></li>
                            <li><a href="#"><i class="fa fa-btn fa-sign-out"></i>newhtf парсить категории</a></li>
                            <li><a href="#"><i class="fa fa-btn fa-sign-out"></i>newhtf парсить продукты</a></li>
                            <li><a href="#"><i class="fa fa-btn fa-sign-out"></i>newhtf допарсить продукты</a></li>
                        </ul>
                    </li>


                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')
<div class="container" style="background-color:#F44336;color:#fff; margin-top: 10px">

    <div class="row">
        <div class="col-xs-6 col-md-3">
            <a href="#" class="">
                О Компании
            </a> <br>
            <a href="#" class="">
                презентация
            </a><br>
            <a href="#" class="">
                преимущества
            </a><br>
            </a>
            <a href="#" class="">
                услуги
            </a><br>
        </div>

        <div class="col-xs-6 col-md-3">
            <a href="#" class="">
                Новости
            </a> <br>
            <a href="#" class="">
                #
            </a><br>
            <a href="#" class="">
                #
            </a><br>
            </a>
            <a href="#" class="">
                #
            </a><br>
        </div>

        <div class="col-xs-6 col-md-3">
            <a href="#" class="">
                Доставка и оплата
            </a> <br>
            <a href="#" class="">
                условия
            </a><br>
            <a href="#" class="">
                стоимость
            </a><br>
            </a>

        </div>

        <div class="col-xs-6 col-md-3">
            <a href="#" class="">
                Сервис и ремонт
            </a> <br>
            <a href="#" class="">
                адреса
            </a><br>
            <a href="#" class="">
                гарантии
            </a><br>
            </a>
            <a href="#" class="">
                документы
            </a><br>
        </div>

    </div>
</div>
<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
