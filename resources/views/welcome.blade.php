<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Le Livre De Jeu</title>


    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lldj-styles.css') }}" rel="stylesheet">

    <style>
        @import url(//fonts.googleapis.com/css?family=Patrick+Hand+SC|Bangers|Happy+Monkey);
        @import url('https://fonts.googleapis.com/css?family=Indie+Flower');

        html, body {

            color: #404040;
            font-family: "Patrick Hand SC";
            font-weight: 200;
            height: 100vh;
            margin: 0;

            background-image: radial-gradient(ellipse farthest-corner, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 35%, #ffffff 30%, #ffffff 40%, rgba(0, 0, 0, 0) 90%),
            radial-gradient(ellipse farthest-corner at 0px 0px, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 20%, #ffffff 15%, #ffffff 20%, rgba(0, 0, 0, 0) 50%),
            radial-gradient(ellipse farthest-corner at 8px 8px, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 20%, #ffffff 15%, #ffffff 20%, rgba(0, 0, 0, 0) 50%),
            radial-gradient(ellipse farthest-corner at 0px 8px, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 20%, #ffffff 15%, #ffffff 20%, rgba(0, 0, 0, 0) 40%),
            radial-gradient(ellipse farthest-corner at 8px 0px, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 20%, #ffffff 15%, #ffffff 20%, rgba(0, 0, 0, 0) 50%),
            linear-gradient(40deg, #bd2d10 0, #f4502f 30%, #ff6e51 50%, #f4502f 70%, #bd2d10 100%);
            background-size: 8px 8px, 8px 8px, 8px 8px, 8px 8px, 8px 8px, 100% 100%;

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
            height: 80%;
            text-align: center;

        }

        .title {

            font-size: 100px;

        }

        .row-title {

            height: 150px;
        }

        .row-buttons {

            height: 150px;
        }

        .links > a {

            color: #1b1b1b;
            font-style: italic;
            padding: 0 25px;

            font-size: 20px;

            font-weight: 600;

            letter-spacing: .1rem;

            text-decoration: none;

            text-transform: uppercase;

        }

        .m-b-md {

            margin-bottom: 30px;

        }

        .big {
            font-family: Bangers;
            margin: 0 0 -1em 0;
            text-shadow: -1px -1px yellow, 1px 1px orange, 2px 2px orange;
            padding-bottom: 50px;
            float: left;
            width: 100%;
        }

        .main {
            margin: 0;
            width: 100%;
            display: block;
            min-height: 400px;
            border-top: none;

        }

        .panel {
            padding: 1em;
            background-size: 8px 8px, 8px 8px, 8px 8px, 8px 8px, 8px 8px, 100% 100%;
            margin-bottom: -4px;

        }

        .red-bg {
            background-image: radial-gradient(ellipse farthest-corner, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 35%, #ffffff 30%, #ffffff 40%, rgba(0, 0, 0, 0) 90%),
            radial-gradient(ellipse farthest-corner at 0px 0px, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 20%, #ffffff 15%, #ffffff 20%, rgba(0, 0, 0, 0) 50%),
            radial-gradient(ellipse farthest-corner at 8px 8px, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 20%, #ffffff 15%, #ffffff 20%, rgba(0, 0, 0, 0) 50%),
            radial-gradient(ellipse farthest-corner at 0px 8px, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 20%, #ffffff 15%, #ffffff 20%, rgba(0, 0, 0, 0) 40%),
            radial-gradient(ellipse farthest-corner at 8px 0px, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 20%, #ffffff 15%, #ffffff 20%, rgba(0, 0, 0, 0) 50%),
            linear-gradient(40deg, #bd2d10 0, #f4502f 30%, #ff6e51 50%, #f4502f 70%, #bd2d10 100%);
        }

        .btn.btn-primary {
            align-self: center;
            padding: 1rem 1rem;
            transition: all .5s ease;
            color: #41403E;
            font-size: 20px;
            letter-spacing: 1px;
            outline: none;
            box-shadow: 20px 38px 34px -26px hsla(0, 0%, 0%, .4);
            border-radius: 255px 15px 225px 15px/15px 225px 15px 255px;

            background-image: radial-gradient(ellipse farthest-corner,
            rgba(0, 0, 0, 0) 0%,
            rgba(0, 0, 0, 0) 35%, #ffffff 30%, #ffffff 40%, rgba(0, 0, 0, 0) 90%),
            radial-gradient(ellipse farthest-corner at 0px 0px, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 20%,
                    #ffffff 15%, #ffffff 20%, rgba(0, 0, 0, 0) 50%),
            radial-gradient(ellipse farthest-corner at 8px 8px, rgba(0, 0, 0, 0) 0%,
                    rgba(0, 0, 0, 0) 20%, #ffffff 15%, #ffffff 20%, rgba(0, 0, 0, 0) 50%),
            radial-gradient(ellipse farthest-corner at 0px 8px, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 20%,
                    #ffffff 15%, #ffffff 20%, rgba(0, 0, 0, 0) 40%),
            radial-gradient(ellipse farthest-corner at 8px 0px, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 20%,
                    #ffffff 15%, #ffffff 20%, rgba(0, 0, 0, 0) 50%),
            linear-gradient(40deg, #ffce55 0, #fffc83 30%, #ffffb1 50%, #fffc83 70%, #ffce55 100%);
            background-size: 4px, 4px, 4px, 4px, 4px, 4px, 4px, 4px, 4px 4px, 100% 100%;

        }

        .btn.btn-primary:hover {
            box-shadow: 2px 8px 4px -6px hsla(0, 0%, 0%, .3);
        }

        .lined.thin {
            border: solid 2px #41403E;
        }

        .lined.thick {
            border: solid 7px #41403E;
        }

        /*cards*/

        .map-background {
            background-image: url(http://wrap.mytopo.com/wrap/netmapwrapper_mytopo.aspx?VERSION=1.1.1&REQUEST=GetMap&layers=drg,hillshade&map=\Mapserver\mapfiles\zone18.map&width=500&height=500&bbox=357614,4110192.07523,360114,4112692.07523&srs=EPSG:26918&format=image/jpeg);
            background-size: cover;
        }

        #card_container {
            border: 10px solid #ffffff;
            box-sizing: border-box;
            width: 250px;
            height: 250px;
            position: relative;
            margin: 50px
        }

        #card {
            border: solid 4px #41403E;

            color: #fff;
            padding: 30px;
            width: 100%;
            height: 100%;
            position: relative;
            z-index: 1;
            /*box-shadow:0px 45px 100px rgba(0, 0, 0, 0.4), inset 0 0 0 1000px rgba(156, 27, 27, 0.6);*/
            box-shadow: 0px 45px 100px rgba(0, 0, 0, 0.4), inset 0 0 0 1000px rgba(0, 76, 86, 0.6);
        }

        #card .text-block {

            position: relative;
            z-index: 2;

        }

        #card .text-block h1 {

            font-size: 3em;
            margin: 0;
            text-transform: uppercase;
            font-weight: 700;
        }

        #card .text-block h1 small {
            font-size: .4em;
            color: #ccc;
            position: relative;
            bottom: 10px;
        }

        #card .text-block h3 {
            margin: 0;
            font-weight: 700;
        }

        #card .text-block p {
            font-weight: 300;
            width: 60%;
        }

        #card .text-block button {
            transition: all 0.35s cubic-bezier(0.37, 0.26, 0.35, 1);
            border: 4px solid #fff;
            padding: 10px;
            background: transparent;
            text-transform: uppercase;
            font-weight: 700;
            cursor: pointer;
        }

        #card .text-block button:hover {
            background: #004c56;
        }

        #card_container .pg {
            position: absolute;
            height: 450px;
            width: 40%;
            right: -10px;
            bottom: 0px;
            z-index: 2;
        }

        #card_container .pg > img {
            height: 450px;
        }

        .shine {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.2) 60%);
            z-index: 1;
        }

        button {
            color: #fff;
        }

        .welcome-card-title {
            font-family: Bangers;
            margin: 0 0 -1em 0;
            text-shadow: -1px -1px #404040, 1px 1px #000000, 2px 2px #000000;
            padding-bottom: 50px;
            float: left;
            width: 100%;
            font-size: 50px;

        }

        .yellow {
            color: #ffce55;
        }

        .green {
            color: #9dc705;
        }

        .orange {
            color: #fa9939;
        }

        .red {
            color: #f3655d;
        }

        .blue {
            color: #51cbf1;
        }

        .violet {
            color: rgb(255, 111, 193);
        }

        .padding10pc {
            padding-left: 10%
        }

        .brand-text {

            font-family: Bangers;
        }


        /*bublles*/
        blockquote.electric {
            background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/electric.svg);
            width: 25%;
            font-size: 2.4vw;
            font-style: italic;
            padding: 4% 6% 12% 0%;
        }
        blockquote.electric span {
            display: block;
            font-size: 3vw;
            font-weight: bold;
        }
        .carousel-inner{
        height: 250px;
        }


    </style>

</head>

<body>

@include('nav.nav')

<div class="flex-center position-ref full-height">


    <div class="content main panel">

        <div class="container">
            @include('_partials.carrousel')
            <div class="row row-buttons">
                <div class="row">
                    <div class="col-lg-9 offset-1">
                        <div class="row">
                            <div class="col-lg-4">
                                @include('_partials.card_container',['type'=>'ready', 'color'=>'yellow','title'=>'Parties', 'route'=>'gamesession.index', 'text'=>'Aller à l\'Index'])
                                @include('_partials.card_container',['type'=>'ready', 'color'=>'green','title'=>'News', 'route'=>'info.index', 'text'=>'l\'actu du site'])
                            </div>
                            <div class="col-lg-4">
                                @include('_partials.card_container',['type'=>'not_done_yet', 'color'=>'orange','title'=>'AARs', 'route'=>'', 'text'=>'En construction'])
                                @include('_partials.card_container',['type'=>'ready', 'color'=>'blue','title'=>'Github', 'route'=>'github', 'text'=>'Voir le repo'])
                            </div>
                            <div class="col-lg-4">
                                @include('_partials.card_container',['type'=>'not_done_yet', 'color'=>'red','title'=>'Tutos', 'route'=>'', 'text'=>'En construction'])
                                @include('_partials.card_container',['type'=>'ready', 'color'=>'violet','title'=>'contact', 'route'=>'contact', 'text'=>'Ecrire un mail'])
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>


</div>

</body>

</html>