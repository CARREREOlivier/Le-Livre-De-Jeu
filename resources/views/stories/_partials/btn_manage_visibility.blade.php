<button type="button" class="btn btn-primary lined thin" data-toggle="modal" data-target="#modalVisibility"
        title="Gérer la visibilité du post">
    <i class="fas fa-eye"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modalVisibility" tabindex="-1" role="dialog" aria-labelledby="modalVisibility"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{ Form::open(array('route' => ['story.update.visibility.post',$story_post->slug], 'method' => 'POST')) }}
            {!! csrf_field() !!}
            <div class="modal-header">
                <h5 class="modal-title" id="modalVisibility"><i class="fas fa-address-card"></i>Qui peut voir?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Rounded switch -->
                <div style="float:left">
                    <label class="switch">
                        <input type="checkbox" onclick="toggleSwitchActions()" name="toggleVisibility" id="toggleVisibility" value="all"
                               checked>
                        <span class="slider round"></span>
                    </label>
                </div>
                <div style="float:left" id="switchLabel"><p>Visible par tous</p></div>

                <input class="form-control" id="searchBar" type="text" placeholder="Cherchage de gens..."/>
                <table>


                    <thead>
                    <th scope="col">Selectionner</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    </thead>
                    <tbody id="usersLists">
                    @foreach($users as$user)
                        @if($user->username <> $author)
                            <tr>

                                @if($user->checked == true)
                                    <td id="selection">{{Form::checkbox("cbCanSee[]", $user->id, true, ['class'=>'ckbox'])}}</td>
                                @else
                                    <td id="selection">{{Form::checkbox("cbCanSee[]", $user->id, false, ['class'=>'ckbox'])}}</td>
                                @endif
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger lined thin" data-dismiss="modal">Annuler</button>
                {{ Form::submit('Valider', ['class' => 'btn btn-secondary lined thin'])}}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!--script for search bar-->
<!-- Note that we start the search in tbody, to prevent filtering the table headers-->
<script type="text/javascript">
    $(document).ready(function () {
        $("#searchBar").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#usersLists tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>

<script>
    function toggleSwitchActions() {

        var x = document.getElementById("toggleVisibility");
        var y = document.getElementById("switchLabel");

        if (x.value === "all") {
            x.value = "none";
            y.innerHTML = "Visible pour les auteur/co-auteurs/personnes sélectionnées";
        } else {
            x.value = "all";
            y.innerHTML = "Visible par tous";
        }
    }
</script>