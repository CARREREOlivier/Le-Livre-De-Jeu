@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Create GameSession Form -->

{!! Form::open(array('route' => 'gameSession.store', 'method' => 'POST')) !!}
{!! csrf_field() !!}
<table>
<tbody>
        <tr><td>{!! Form::label('title', 'Titre de la partie (obligatoire):') !!}</td>
            <td> {!! Form::text('title') !!}</td></tr>

        <tr><td>{!! Form::label('game', 'Jeu (optionnel):') !!}</td>
            <td> {!! Form::text('game') !!}</td></tr>

        <tr><td>{!! Form::label('description', 'Description (optionnel):') !!}</td>
            <td>{!! Form::textarea('description') !!}</td></tr>
</tbody>


</table>
<!--this button allows to expand the users' list tyhrough a collpasible-->
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseUserList"
        aria-expanded="false" aria-controls="collapseUserList">
    Ajouter des joueurs
</button>
<div class="collapse" id="collapseUserList">
    <div class="card card-body">

        <!--note that search is inserted in body to avoid searching headers-->

        <input class="form-control" id="searchBar" type="text" placeholder="Cherchage de gens..."/>
        <table>

            <thead>
            <th>Select</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            </thead>
            <tbody id="usersLists">

            @foreach($users as$user)
                <tr>
                    <td id="selection">{{Form::checkbox("checkBox[]", $user->id, null, ['class'=>'ckbox'])}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
{!! Form::submit('Créer', array('class'=>'btn btn-primary')) !!}
{!! Form::close() !!}
<div id="ecriture"></div>
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
