{!! Form::open(array('route' => 'turnorder.store', 'method' => 'POST')) !!}
{!! csrf_field() !!}
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
{!! Form::submit('Ajouter', array('class'=>'btn btn-primary')) !!}
{!! Form::close() !!}