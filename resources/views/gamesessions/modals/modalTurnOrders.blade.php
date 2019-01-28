<!-- Button trigger modal -->
<button type="button" class="btn btn-primary lined thin" data-toggle="modal"
        data-target="#modalAddOrder{{$gameTurn->id}}">
    Ajouter mon ordre
</button>

<!-- Order Modal -->
<div class="modal fade" id="modalAddOrder{{$gameTurn->id}}" tabindex="-1" role="dialog"
     aria-labelledby="modalAddOrder{{$gameTurn->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open(array('route' => 'turnorder.store', 'method' => 'POST')) !!}
        {!! csrf_field() !!}
        {!! Form::hidden('gameturn_id',$gameTurn->id) !!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddOrder{{$gameTurn->id}}"><i class="fas fa-signature"></i>Enregistrer
                    mes ordres</h5>
                <button type="button" class="btn btn-primary lined thin" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">

                <table>
                    <tbody>
                    <tr>
                        <td> {!! Form::label('message', 'Message:') !!}</td>
                    </tr>
                    <tr>

                        <td> {!! Form::textarea('message') !!}</td>
                    </tr>
                    </tbody>
                </table>


            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-primary lined thin" data-dismiss="modal">Annuler
                </button>
                {!! Form::submit('Ajouter', array('class'=>'btn btn-secondary lined thin')) !!}
            </div>

        </div>
        {!! Form::close() !!}
    </div>
</div>