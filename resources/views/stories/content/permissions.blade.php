<div class="row">
    <table>
        <tr>
            <td><h1 class='title'>Permissions pour l'AAR</h1></td>
            <td>
                &nbsp;&nbsp;&nbsp;<button class="btn btn-secondary lined thin" type="button" title="aide"
                                          data-toggle="modal" data-target="#helpModal">
                    <i class="fas fa-question fa-xs fa-pulse"></i></button>
            </td>
        </tr>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="helpModalLabel">Aide sur les permissions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table-primary table-bordered">
                        <caption style="caption-side: top; color:blue;">Les Editeurs</caption>
                        <thead class="thead-dark">
                        <td style="font-weight:bold;">peuvent</td>
                        <td style="font-weight:bold;">ne peuvent pas</td>
                        </thead>
                        <tbody>
                        <tr>
                            <td>modifier l'introduction</td>
                            <td>Effacer l'intégralité de l'AAR avec tout ses posts</td>
                        </tr>
                        <tr>
                            <td>créer un post</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>modifier un post</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>effacer un post</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>

                    <p>Auteurs: peuvent créer des posts et les modifiers</p>
                    <p>Interdits: ne peuvent pas accéder à l'AAR (même pas lire l'introduction)</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary lined thin" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--current users roles strip-->
<div class="row strip white-bg">
    <div class="col-md-4  archive-left">
        <div class="evenboxinner-turn">
            Editeurs
        </div>
        <div class='vignette blue-bg'>Editeurs</div>
    </div>
    <div class="col-md-4 archive-center">
        <div class="evenboxinner-descriptive">
            Auteurs
        </div>
        <div class='vignette yellow-bg'>Auteurs</div>
    </div>

    <div class="col-md-4 archive-right">
        <div class="evenboxinner-descriptive">
            Interdits
        </div>
        <div class='vignette red-bg'>Interdits</div>
    </div>


</div>
<!--search bar-->
<p>include: Search bar module</p>

<!--ajouter nouveaux utilisateurs-->
<p>gérer utilisateurs</p>
<table class="table-hover">
    <thead>
    <tr>
        <td>Pseudo</td>
        <td>role</td>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)

        <tr>
            <td>{{$user->username}}</td>
            <td><select>
                    @foreach($roles as $role)
                        <option value="role">{{$role}}</option>
                    @endforeach </select></td>
        </tr>

    @endforeach
    </tbody>
</table>