<button class="btn btn-secondary lined thin" data-toggle="collapse" data-target="#table_users">Voir la liste
</button>

<div id="table_users" class="collapse">
    <table class="table-hover table-bordered white-bg vignette">
        <thead>
        <th scope="col">Id</th>
        <th scope="col">Created</th>
        <th scope="col">Updated</th>
        <th scope="col">Pseudo</th>
        <th scope="col">Email</th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->updated_at}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->status}}</td>
                <td>@include('admin._partials.change_status')</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>