
<h1 class="big"> Le Livre de jeu</h1>
<div class="row row-strip"><div class="vignette green-bg"><h3>Vous avez reçu un message de {!! $email->sender!!}</h3></div></div>
<div class="row row-strip">
    <div class="vignette green-bg">
        <p><b> Message : </b></p>
        Un nouveau tour vient d'être publié.
        {!!  $email->message !!}

        Cordialement, Le livre de jeu
    </div>
</div>

