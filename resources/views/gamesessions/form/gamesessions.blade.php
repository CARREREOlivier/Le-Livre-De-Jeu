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

{!! Form::open(array('route' => 'gamesession.store', 'method' => 'POST')) !!}
{!! csrf_field() !!}
<ul>

    <li>
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title') !!}
    </li>
    <li>
        {!! Form::label('game', 'Game:') !!}
        {!! Form::text('game') !!}
    </li>
    <li>
        {!! Form::label('description', 'Description:') !!}
        {!! Form::textarea('description') !!}
    </li>

</ul>
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
{!! Form::submit() !!}
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
