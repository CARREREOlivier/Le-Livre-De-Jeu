<div class="dropdown d-inline-block">
    <button class="btn btn-secondary dropdown-toggle lined thin" type="button" id="dropdownMenuButton"
            data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bars"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" data-toggle="modal" data-target="#modalDropzone{{$order->id}}"><i
                    class="fas fa-file-upload"></i> Ajouter un fichier</a>
        <a class="dropdown-item" data-toggle="modal" data-target="#modalEditOrder{{$order->id}}"><i
                    class="fas fa-edit"></i>Editer</a>
        <a class=" dropdown-item" data-toggle="modal" data-target="#modalDeleteOrder{{$order->id}}"><i
                    class="fas fa-trash"></i>Supprimer</a>
    </div>
</div>
