<div class="row row-title"><h1 class="big title">Admin</h1></div>
<div class="row strip">
    <div class="col-lg vignette green-bg"><p>Utilisateurs</p>
        Ajouter un utilisateur
        <table class="table-hover table-bordered">
            <thead>
            <th scope="col">Id</th>
            <th scope="col">Pseudo</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->status}}</td>
                    <td>modifier-supprimer-changer statut</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row strip">
    <div class="col-lg vignette blue-bg"><p>Parties</p></div>
</div>
