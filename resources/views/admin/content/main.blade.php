<div class="row row-title"><h1 class="big title">Admin</h1></div>
<div class="row strip">
    <div class="col-lg vignette green-bg">
        <h2 class="welcome-card-title red">Utilisateurs</h2>
        <br/>
        <hr>

        @include('admin._partials.add_user')
        @include('admin._partials.table_users')

    </div>
</div>
<div class="row strip">
    <div class="col-lg vignette blue-bg">
        <h2 class="welcome-card-title yellow">Parties</h2>
        <br/>
        <hr>
        @include('admin._partials.add_gamesession')
        @include('admin._partials.table_gamesessions')
    </div>
</div>
