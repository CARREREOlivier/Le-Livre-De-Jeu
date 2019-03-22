@auth()
    @if(Auth::User()->status=='Admin')
    <div class="row strip" id="index_actions_strip">
        <div class="col-12 red-bg vignette">
           bouton ici
        </div>
    </div>
    @endif
@endauth