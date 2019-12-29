<button type="button" class="btn btn-primary lined thin" data-toggle="modal" data-target="#modalAddPlayers" title="ajouter/retirer des co-auteurs pour ce post uniquement">
    <i class="fas fa-users"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modalAddPlayers" tabindex="-1" role="dialog" aria-labelledby="modalAddPlayers" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddPlayersLabel"><i class="fas fa-address-card"></i> Joueurs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                            <td id="selection">{{Form::checkbox("checkBox[]", $user->id, null, ['class'=>'ckbox'])}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary lined thin" data-dismiss="modal">Ok</button>

            </div>
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