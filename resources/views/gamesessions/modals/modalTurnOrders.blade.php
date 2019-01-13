<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal"
        data-target="#exampleModal{{$gameTurn->id}}">
    Ajouter mon ordre
</button>

<!-- Order Modal -->
<div class="modal fade" id="exampleModal{{$gameTurn->id}}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel{{$gameTurn->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open(array('route' => 'turnorder.store', 'method' => 'POST')) !!}
        {!! csrf_field() !!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel{{$gameTurn->id}}">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                {{$gameTurn->id}}

                <ul>
                    <li>
                        {!! Form::label('gameturn_id', 'tor:') !!}
                        {!! Form::text('gameturn_id',$gameTurn->id) !!}
                    </li>
                    <li>
                        {!! Form::label('message', 'Message:') !!}
                        {!! Form::text('message') !!}
                    </li>

                </ul>


            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                </button>
                {!! Form::submit('Ajouter', array('class'=>'btn btn-primary')) !!}
            </div>

        </div>
        {!! Form::close() !!}
    </div>
</div>