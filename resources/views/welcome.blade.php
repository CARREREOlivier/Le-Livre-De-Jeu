<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Le livre de jeu') }}</title>

    <!-- Scripts-->
    <script src="https://tympanus.net/Development/AnimatedBooks/js/modernizr.custom.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Indie+Flower"/>

    <!-- Styles -->

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">


    <style>
        @import url(//fonts.googleapis.com/css?family=Patrick+Hand+SC|Bangers|Happy+Monkey);
        html, body {
            min-height: 100%;
        }




        .container {
            margin: 0px;
            color: #404040;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .big {
            font-size: 84px;
            margin-bottom: -.75em;
        }
        .title {


            font-family: "Bangers";
            margin: 0 0 -1em 0;
            text-shadow: -1px -1px yellow, 1px 1px orange,  2px 2px orange;
            padding-bottom: 50px;
            float: left;
            width: 100%;
        }

        .links > a {
            color: #404040;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            font-family: Indie Flower;
        }
        .m-b-md {
            margin-bottom: 30px;
        }

        .btn {
            color: #404040;
            border: #404040;
            font-family: Indie Flower;
        }

        #parties {
            color: #4e555b;
            border: 2px solid #1b1b1b
        }

        #partiesLink {
            color: #4e555b;
            border: 2px solid #404040
        }

        .inPage {
            color: #404040;
            font-family: Indie Flower;

        }

    </style>
</head>
<body>
<div class="container-fluid">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                    @endauth
        </div>
    @endif


    <div class="row">
        <div class="'col-lg">


            <div class="row">
                <div class="links">
                    <div class="container">
                        <div class="component">

                            <ul class="align">
                                <div class="title m-b-md big">
                                    Le Livre De Jeu
                                </div>
                                <li>
                                    <figure class='book'>
                                        <!-- Front -->
                                        <ul class='hardcover_front'>
                                            <li>
                                                <img src="https://cliophage.files.wordpress.com/2014/12/tuniques-bleues-capitaine-stark.jpg?w=640"
                                                     alt="" width="100%" height="100%">
                                            </li>
                                            <li></li>
                                        </ul>

                                        <!-- Pages -->

                                        <ul class='page'>
                                            <li></li>
                                            <li><br/><br/><br/><br/>
                                                <p class="inPage">Créez, gérez et lisez les parties tour par tour.</p>
                                            </li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                        </ul>

                                        <!-- Back -->

                                        <ul class='hardcover_back'>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                        <ul class='book_spine'>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                        <figcaption>
                                            <h2><a class="btn" href="{{route('gamesession.index')}}" id="partieslink">Parties</a>
                                            </h2>
                                            <span></span>

                                        </figcaption>
                                    </figure>
                                </li>
                                <li>
                                    <figure class='book'>
                                        <!-- Front -->
                                        <ul class='hardcover_front'>
                                            <li>
                                                <img src="https://static.fnac-static.com/multimedia/Images/FR/NR/b3/d9/40/4250035/1507-0/tsp20150813011121/After-Action-Report-on-the-Actions-of-the-20th-Maine-at-Gettysburg.jpg"
                                                     alt="" width="100%" height="100%">
                                            </li>
                                            <li></li>
                                        </ul>

                                        <!-- Pages -->

                                        <ul class='page'>
                                            <li></li>
                                            <li><br/><br/><br/><br/>
                                                <p class="inPage">Ecrire et lire les AARs</p></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                        </ul>

                                        <!-- Back -->

                                        <ul class='hardcover_back'>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                        <ul class='book_spine'>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                        <figcaption>
                                            <h2><a class="btn" href="#">Récits</a></h2>
                                            <span></span>

                                        </figcaption>
                                    </figure>
                                </li>
                                <li>
                                    <figure class='book'>

                                        <!-- Front -->

                                        <ul class='hardcover_front'>
                                            <li>
                                                <img src="https://s3-us-west-2.amazonaws.com/cosmicjs/e7ce1f70-27c7-11e7-9631-b17e7278f329-github.svg"
                                                     alt="" width="100%" height="100%">
                                            </li>
                                            <li></li>
                                        </ul>

                                        <!-- Pages -->

                                        <ul class='page'>
                                            <li></li>
                                            <li><br/><br/><br/><br/>
                                                <p class="inPage">Voir/cloner le repo du projet sur github</p></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                        </ul>

                                        <!-- Back -->

                                        <ul class='hardcover_back'>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                        <ul class='book_spine'>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                        <figcaption>
                                            <h2><a class="btn" href="https://github.com/Flefounet/Le-Livre-De-Jeu">Github</a>
                                            </h2>
                                            <span></span>

                                        </figcaption>
                                    </figure>
                                <li>
                                    <figure class='book'>
                                        <!-- Front -->
                                        <ul class='hardcover_front'>
                                            <li>
                                                <img src="http://www.lyricama.com/wp-content/uploads/2015/09/3-reclamation-img-220x165.jpg"
                                                     alt="" width="100%" height="100%">
                                            </li>
                                            <li></li>

                                        </ul>

                                        <!-- Pages -->

                                        <ul class='page'>
                                            <li></li>
                                            <li><br/><br/><br/><br/>
                                                <p class="inPage">Contacter l'administrateur du site</p></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                        </ul>

                                        <!-- Back -->

                                        <ul class='hardcover_back'>

                                            <li>

                                            </li>
                                            <li></li>

                                        </ul>
                                        <ul class='book_spine'>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                        <figcaption>
                                            <h2><a class="btn" href="#">Contact</a></h2>
                                            <span></span>

                                        </figcaption>
                                    </figure>

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
