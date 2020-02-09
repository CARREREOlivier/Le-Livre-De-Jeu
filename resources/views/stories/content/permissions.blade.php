<div class="row">
    <table>
        <tr>
            <td><h1 class='title'>Permissions pour l'AAR</h1></td>
            <td>
                &nbsp;&nbsp;&nbsp;<button class="btn btn-secondary lined thin" type="button" title="aide"
                                          data-toggle="modal" data-target="#helpModal" tooltip="yes">
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
                    <p>Les droits définissent les permissions diverses accordées aux utilisateurs.
                        Les utilisateurs loggués ou non peuvent toujours consulter un AAR et ses posts sauf dispositions
                        contraires au niveau de la visibilité dans les posts</p>
                    <p> Les éditeurs ont tout les droits à part celui d'effacer intégralement l'AAR (réservé au créateur
                        de l'AAR)</p>
                    <p> Les Auteurs peuvent mettre en ligne des posts</p>

                    <table class="table-bordered">
                        <caption style="caption-side: top; color:blue;">Droits en fonction du role</caption>
                        <thead class="thead">
                        <td style="font-weight:bold;">Droit</td>
                        <td style="font-weight:bold;">Editeurs</td>
                        <td style="font-weight:bold;">Auteurs</td>
                        </thead>
                        <tbody>
                        <tr>
                            <td>modifier l'introduction</td>
                            <td><i class="fas fa-check" style="color:seagreen;"></i></td>
                            <td><i class="fas fa-times" style="color:darkred"></i></td>
                        </tr>
                        <tr>
                            <td>créer un post</td>
                            <td><i class="fas fa-check" style="color:seagreen;"></i></td>
                            <td><i class="fas fa-check" style="color:seagreen;"></i></td>
                        </tr>
                        <tr>
                            <td>modifier un post</td>
                            <td><i class="fas fa-check" style="color:seagreen;"></i></td>
                            <td><i class="fas fa-check" style="color:seagreen;"></i></td>
                        </tr>
                        <tr>
                            <td>effacer un post</td>
                            <td><i class="fas fa-check" style="color:seagreen;"></i></td>
                            <td><i class="fas fa-check" style="color:seagreen;"></i></td>
                        </tr>
                        <tr>
                            <td>modifier n'importe quel post</td>
                            <td><i class="fas fa-check" style="color:seagreen;"></i></td>
                            <td><i class="fas fa-times" style="color:darkred"></i></td>
                        </tr>
                        <tr>
                            <td>effacer n'importe quel post</td>
                            <td><i class="fas fa-check" style="color:seagreen;"></i></td>
                            <td><i class="fas fa-times" style="color:darkred"></i></td>
                        </tr>
                        <tr>
                            <td style="white-space: normal;
                                word-wrap: break-word; max-width: 150px ">Effacer l'intégralité de l'AAR avec tout ses
                                posts
                            <td><i class="fas fa-times" style="color:darkred"></i></td>
                            <td><i class="fas fa-times" style="color:darkred"></i></td>
                        </tr>
                        </tbody>
                    </table>

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
    <div class="col-md-6  archive-left ">
        <div class="evenboxinner-turn">
            Editeurs

        </div>
        <div class='vignette blue-bg full-height'>

            @foreach($storyRoles as $storyRole)
                @if($storyRole->role === 'Editor')
                    {{$storyRole->getUserNames->username}}
                @endif
            @endforeach

        </div>
    </div>
    <div class="col-md-6 archive-right">
        <div class="evenboxinner-descriptive">
            Auteurs
        </div>
        <div class='vignette yellow-bg full-height'>

            @foreach($storyRoles as $storyRole)

                @if($storyRole->role === 'Author')
                    {{$storyRole->getUserNames->username}}
                @endif

            @endforeach

        </div>
    </div>

</div>
<!--search bar-->
<p>include: Search bar module</p>


<div class="row strip white-bg">
    <div class='vignette green-bg full-height'>
        <h3>Gestion des permissions</h3>
        {{Form::open(array('route' => array('story.update.permissions',$slug),'method' => 'POST'))}}

        {!! csrf_field() !!}
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
                    <td>
                        @foreach($storyRoles as $storyRole)
                            @if($storyRole->user_id === $user->id)
                                @switch($storyRole->role)
                                    @case('Editor')
                                    {{Form::select("size_$user->id", array('Editor' => 'Editeur', 'Author' => 'Auteur','None'=>'Aucun'), 'Editor')}}
                                    @break;

                                    @case('Author')
                                    {{Form::select("size_$user->id", array('Editor' => 'Editeur', 'Author' => 'Auteur','None'=>'Aucun'), 'Author')}}
                                    @break;

                                @endswitch

                            @else
                                {{Form::select("size_$user->id", array('Editor' => 'Editeur', 'Author' => 'Auteur','None'=>'Aucun'), 'None')}}
                            @endif
                        @endforeach


                    </td>
                </tr>

            @endforeach

            </tbody>

        </table>


        {{Form::submit('Mettre à jour',['class'=>'btn btn-secondary lined thin float-right'])}}
        {{Form::close()}}
    </div>
</div>
<script type="text/javascript">
    $(function () {

        $('[tooltip="yes"]').tooltip()
    })
</script>