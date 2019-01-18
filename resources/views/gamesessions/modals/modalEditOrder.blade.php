<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal"
        data-target="#modalEditOrder{{$gameTurn->id}}">
    Editer mon ordre
</button>

<!-- Order Modal -->
<div class="modal fade" id="modalEditOrder{{$gameTurn->id}}" tabindex="-1" role="dialog"
     aria-labelledby="modalEditOrder{{$gameTurn->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::model($orders, array('route' => array('turnorder.update', $order->id),'method' => 'PUT')) !!}
        {!! csrf_field() !!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaleditOrder{{$order->id}}"><i class="fas fa-signature"></i>Enregistrer mes ordres</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">

                <table>
                    <tbody>
                    {!! Form::hidden('gameturn_id',$gameTurn->id) !!}

                    <tr>
                        <td> {!! Form::label('message', 'Message:') !!}</td>
                        <td> {!! Form::textarea('message', $order->message) !!}</td>
                    </tr>
                    </tbody>
                </table>


            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler
                </button>
                {!! Form::submit('Editer', array('class'=>'btn btn-primary')) !!}
            </div>

        </div>
        {!! Form::close() !!}
    </div>
</div>