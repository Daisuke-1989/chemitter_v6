<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        .chemheight { height: 150px !important; }
    </style>
</head>
<body>
    <div id="navbar">
        <nav class="navbar">
            <div class="navbar-brand">
                <a class="navbar-item" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <a id="burger" role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample" onclick="menuToggle()">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="{{ route('tweets.index') }}">
                        Timeline
                    </a>

                    <a class="navbar-item" href="{{ route('users.index') }}">
                        Users
                    </a>
                </div>
                <ul class="navbar-end">
                    <!-- Authentication Links -->
                    @guest
                        <li class="navbar-item">
                            <div class="buttons">
                                <a class="button" href="{{ route('login') }}">{{ __('Login') }}</a>
                                <a class="button" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </div>
                        </li>
                    @else
                        <li class="navbar-item">
                            <img src="{{ asset('storage/profile_image/' .auth()->user()->profile_image) }}" class="is-rounded" width="50" height="50">
                        </li>
                        <li class="navbar-item">
                            <a href="{{ url('tweets/create') }}">tweet</a>
                        </li>
                        <li class="navbar-item has-dropdown is-hoverable">
                            <a id="navbarDropdown" class="navbar-link" aria-haspopup="true" aria-expanded="false">
                                <span>{{ auth()->user()->name }}</span>
                            </a>
                            <div class="navbar-dropdown" aria-labelledby="navbarDropdown">
                                <a href="{{ url('users/' .auth()->user()->id) }}" class="navbar-item">Profile</a>
                                <a href="{{ route('logout') }}" class="navbar-item"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </nav>
            </div>
            <main class="container">
                @yield('content')
            </main>
            <script src="https://unpkg.com/vue"></script>
            <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
            <script src="{{ asset('node_modules/jsme/jsme/jsme.nocache.js') }}"></script>
            <script src="{{ asset('node_modules/openchemlib/dist/openchemlib-full.js') }}"></script>
            <script>
                function jsmeOnLoad() {
                    jsmeApplet = new JSApplet.JSME("jsme_container", "360px", "340px");
                    let canvasData = document.getElementById('canvas');
                    let idCode = canvasData.getAttribute('data-idcode');
                    let mol = OCL.Molecule.fromIDCode(idCode);
                    let molFile = mol.toMolfile();
                    jsmeApplet.readMolFile(molFile);
                    OCL.StructureView.showStructures('actstruct');
                }
                let burger =document.getElementById("burger");
                let nabvar =document.getElementById("navbarBasicExample");
                function menuToggle(){
                    burger.classList.toggle("is-active");
                    nabvar.classList.toggle("is-active");
                }
                document.addEventListener('DOMContentLoaded', function() {
                    // 1. DOMが読み込まれた際に`.dropdown-trigger`のClassを持つHTMLElementを検索
                    var nodelist = document.querySelectorAll('.dropdown-trigger');
                    var elements = Array.prototype.slice.call(nodelist, 0);

                    elements.forEach(function(element) {
                        // 2. Dropdownの開閉ボタンを取得と、開閉を管理するDropdownのElementを取得
                        var button = element.querySelector('button');
                        var dropdown = element.parentNode;

                        // 3. Dropdownの開閉ボタンがクリックされた際に、`is-active`クラスを追加するイベント追加
                        button.addEventListener('click', function() {
                            event.stopPropagation();
                            dropdown.classList.toggle('is-active');
                        });
                    });
                });
            </script>
            <script>
                var app = new Vue({
                el: '#app',
                created() {
                },
                data: {
                    iconsModalFlg: false,
                },
                methods: {
                    setData: function () {
                        let molFile = jsmeApplet.molFile();
                        console.log(molFile);
                        let setMol = OCL.Molecule.fromMolfile(molFile + '');
                        let setID = setMol.getIDCode();
                        let idcode = document.getElementById('idcode');
                        let canvas = document.getElementById('canvas');
                        idcode.setAttribute("value", setID);
                        canvas.setAttribute("data-idcode", setID);
                        OCL.StructureView.showStructures('actstruct');
                        jsmeModalApplet.readMolFile(molFile);
                    }
                }})
            </script>
</body>
</html>
