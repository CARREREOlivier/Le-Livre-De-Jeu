<h1 class="big"> Le Livre de jeu</h1>
<h3>Nouveau fichier d'ordre uploadé</h3>
<div class="row row-strip">
    <div class="vignette green-bg"><h4>Le joueur {!! $email->recipient!!} a publié un ordre</h4></div>
</div>
<div class="row row-strip">
    <div class="vignette green-bg">
        <h3> Tour : {!! $email->turn_title !!}</h3>
    </div>
</div>
<div class="row row-strip">
    <div class="vignette green-bg"><p>{!! $email->sender!!} a joué</p></div>
</div>
<div class="row row-strip">
    <div class="vignette green-bg">
        <p><b> Message : </b></p>

        {!! $email->message!!}
        <br/>
        Cordialement,
        <br/>
        Le Livre de Jeu
    </div>
</div>
