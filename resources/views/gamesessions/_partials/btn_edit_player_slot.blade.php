<!-- Edit Order Trigger Modal Button -->
<button type="button" class="btn btn-primary lined thin"
        data-toggle="modal"
        data-target="#modalEditOrder{{$orders->get($user_id)->id}}">
    <i class="fas fa-edit"></i>
</button>
<!-- Edit Order Modal -->

<div class="modal fade"
     id="modalEditOrder{{$orders->get($user_id)->id}}"
     tabindex="-1" role="dialog"
     aria-labelledby="modalEditOrder{{$orders->get($user_id)->id}}"
     aria-hidden="true">
    <div class="modal-dialog" role="document">

{!! Form::model($orders, array('route' => array('turnorder.update', $orders->get($user_id)->id),'method' => 'PUT')) !!}
{!! csrf_field() !!}
{!! Form::hidden('gameturn_id',$turn) !!}
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title"
            id="modaleditOrder{{$orders->get($user_id)->id}}">
            <i class="fas fa-signature"></i>Enregistrer
            mes ordres</h5>
        <button type="button" class="close"
                data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>
    <div class="modal-body">

        <table>
            <tbody>
            <tr>
                <td> {!! Form::label('message', 'Message:') !!}</td>
                <td> {!! Form::textarea('message', $orders->get($user_id)->message, array('id'=>'slotTextArea'))!!}</td>
            </tr>
            </tbody>
        </table>


    </div>

    <div class="modal-footer">

        <button type="button"
                class="btn btn-primary lined thin"
                data-dismiss="modal">Annuler
        </button>
        {!! Form::submit('Editer', array('class'=>'btn btn-secondary lined thin')) !!}
    </div>

</div>
{!! Form::close() !!}

</div>
    <script>
        CKEDITOR.replace( 'slotTextArea' );
    </script>
</div>