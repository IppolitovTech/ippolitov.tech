<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @isset($title)
    <meta name="description" content="{{$title}}">
    <title>{{$title}}</title>
    @endisset
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>

<body>
    <div id="app">
        @isset($title)
        <div>
            <div>
                <header-menu :currentlink='@json($currentLink)' :mainmenulinks='@json($mainMenuLinks)' :portfolioclose='@json($portfolioClose)' :portfoliowork='@json($portfolioWork)' :pagedata='@json($pageData)' :sitename='@json(config("app.name", "Laravel"))' />
            </div>
            @yield('content')
        </div>
        @endisset
        @if(!isset($title))
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
@if($currentLink=='page')
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [{
            "@type": "Article",
            "isPartOf": {
                "@id": "{{ url()->current() }}"
            },
            "author": {
                "@type": "Person",
                "name": "Konstantin",
                "url": "{{ url()->current() }}"
            },
            "headline": "{{$pageData['pages']['current']['header']}} | konstantindev.com",
            "datePublished": "{{$pageData['pages']['current']['created_at']}}",
            "dateModified": "{{$pageData['pages']['current']['updated_at']}}",
            "publisher": {
                "@type": "Person",
                "@id": "https://konstantindev.com/#person"
            },
            "inLanguage": "en-US",

            "description": "{{strip_tags($pageData['pages']['current']['text'])}}"
        }]
    }
</script>
@endif