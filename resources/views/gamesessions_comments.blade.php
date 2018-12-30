{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('user_id', 'User_id:') !!}
			{!! Form::text('user_id') !!}
		</li>
		<li>
			{!! Form::label('gamesessions_id', 'Gamesessions_id:') !!}
			{!! Form::text('gamesessions_id') !!}
		</li>
		<li>
			{!! Form::label('text', 'Text:') !!}
			{!! Form::textarea('text') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}