
<h1 class="big"> Le Livre de jeu</h1>
<h3>Nouveau tour disponible!</h3>
<div class="row row-strip"><div class="vignette green-bg"><h4>Le maitre de jeu {!! $email->sender!!} a publié le tour {!! $email->turn_title !!} </h4></div></div>
<div class="row row-strip"><div class="vignette green-bg"><p>Le tour est accessible par ce lien : {!! $email->link !!}</p></div></div>
<div class="row row-strip">
    <div class="vignette green-bg">
        <p><b> Message : </b></p>

        {!!  $email->message !!}
        <br/>
        Cordialement,
        <br/>
        Le Livre de Jeu
    </div>
</div>

