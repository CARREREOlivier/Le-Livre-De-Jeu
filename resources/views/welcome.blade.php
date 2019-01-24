<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Le livre de jeu') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://tympanus.net/Development/AnimatedBooks/css/normalize.css"/>
    <link rel="stylesheet" type="text/css" href="https://tympanus.net/Development/AnimatedBooks/css/demo.css"/>
    <link rel="stylesheet" type="text/css" href="https://tympanus.net/Development/AnimatedBooks/css/book.css"/>
    <link rel="stylesheet" type="text/css" href="https://tympanus.net/Development/AnimatedBooks/css/book2.css"/>
    <script src="https://tympanus.net/Development/AnimatedBooks/js/modernizr.custom.js"></script>
    <style>
        html, body {
            min-height: 100%;
        }

        body {
            color: #404040;
            background: #282537;
            background-image: -webkit-radial-gradient(top, circle cover, #3c3b52 0%, #252233 80%);
            background-image: -moz-radial-gradient(top, circle cover, #3c3b52 0%, #252233 80%);
            background-image: -o-radial-gradient(top, circle cover, #3c3b52 0%, #252233 80%);
            background-image: radial-gradient(top, circle cover, #3c3b52 0%, #252233 80%);
        }

        .container {
            margin:0px;
            color: #ffffff;
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

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .btn{ color: #f4f3ff;
            border: #f4f3ff;
        }

        #parties{ color : #4e555b;
            border: 2px solid #1b1b1b
        }
        #partiesLink{ color : #4e555b;
            border: 2px solid #f4f3ff
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
                                <div class="title m-b-md">
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
                                            <li><a class="btn" href="{{route('gamesession.index')}}" id="parties">Lire</a></li>
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
                                            <h2><a class="btn" href="{{route('gamesession.index')}}" id="partieslink">Parties</a></h2>
                                            <span></span>
                                            <p>Créez, gérez et lisez les parties tour par tour.</p>
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
                                            <li><a class="btn btn-primary" href="https://github.com/Flefounet/Le-Livre-De-Jeu">Lire</a></li>
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
                                            <h2><a class="btn" href="https://github.com/Flefounet/Le-Livre-De-Jeu">Github</a></h2>
                                            <span></span>
                                            <p>Voir/cloner le repo du projet sur github</p>
                                        </figcaption>
                                    </figure>
                                <li>
                                    <figure class='book'>
                                        <!-- Front -->
                                        <ul class='hardcover_front'>
                                            <li>
                                                <img src="https://image.flaticon.com/icons/svg/321/321817.svg"
                                                     alt="" width="100%" height="100%">
                                            </li>
                                            <li></li>

                                        </ul>

                                        <!-- Pages -->

                                        <ul class='page'>
                                            <li></li>
                                            <li><a class="btn" href="#">Aller à</a></li>
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
                                            <p>Contacter l'administrateur du site</p>
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
                                            <li><a class="btn" href="#">Lire</a></li>
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
                                            <p>Ecrire et lire les AARs... Si vous pouvez!</p>
                                        </figcaption>
                                    </figure>
                                </li>
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
