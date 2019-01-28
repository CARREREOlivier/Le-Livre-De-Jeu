{!! Form::open(array('route' => 'turnorder.store', 'method' => 'POST')) !!}
{!! csrf_field() !!}

		{!! Form::hidden('gameturn_id',$gameTurn->id) !!}
<div class="col-12">
		{!! Form::label('message', 'Message:') !!}
		{!! Form::textarea('message') !!}
</div>
{!! Form::submit('Ajouter', array('class'=>'btn btn-secondary lined thin')) !!}
{!! Form::close() !!}