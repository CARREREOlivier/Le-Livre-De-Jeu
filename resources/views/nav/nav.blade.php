<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @if(Route::currentRouteName()=='welcome')
                    <li class="nav-item active ">
                        <a class="nav-link" href="{{ url('/') }}">
                            <mark>Accueil</mark>
                        </a>
                    </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Accueil</a>
                </li>
                @endif

                @if(Route::currentRouteName()=='gamesession.index')
                    <li class="nav-item active ">
                        <a class="nav-link" href="{{ route('gamesession.index') }}">
                            <mark>Parties</mark>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gamesession.index') }}">Parties</a>
                    </li>
                @endif


                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/Flefounet/Le-Livre-De-Jeu">GitHub</a>
                </li>

                @if(Route::currentRouteName()=='contact')
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('contact') }}">
                            <mark>Contact</mark>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}"> Contact</a>
                    </li>
                @endif

                @auth
                @if(Auth::user()->status=="Admin")
                            <li class="nav-item">
                                <a class="nav-link" href="{{route(('admin.main'))}}">Admin</a>
                            </li>
               @endif



                @endauth

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Se connecter</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">S'enregistrer</a>
                        </li>
                    @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Déconnexion
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
            </ul>
        </div>
    </div>
</nav>