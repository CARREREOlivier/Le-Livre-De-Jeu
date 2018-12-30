{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('user_id', 'User_id:') !!}
			{!! Form::text('user_id') !!}
		</li>
		<li>
			{!! Form::label('gamesession_id', 'Gamesession_id:') !!}
			{!! Form::text('gamesession_id') !!}
		</li>
		<li>
			{!! Form::label('gamerole', 'Gamerole:') !!}
			{!! Form::text('gamerole') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}