<h3>Nouveau tour disponible sur le Livre De Jeu</h3>
<div class="row row-strip">
    <div class="vignette green-bg"><h4>Le maitre de jeu {!! $email->sender!!} a publié le tour: </h4></div>
</div>
<div class="row row-strip">
    <div class="vignette green-bg">
        <h3> {!! $email->turn_title !!}</h3>
    </div>
</div>
<div class="row row-strip">
    <div class="vignette green-bg"><p>Le tour est accessible par ce lien : <a href="{!! $email->link !!}" target="_blank" rel="nofollow">{!! $email->link !!}</a></p></div>
</div>
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

