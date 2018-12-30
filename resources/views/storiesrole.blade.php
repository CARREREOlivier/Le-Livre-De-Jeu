{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('user_id', 'User_id:') !!}
			{!! Form::text('user_id') !!}
		</li>
		<li>
			{!! Form::label('story_id', 'Story_id:') !!}
			{!! Form::text('story_id') !!}
		</li>
		<li>
			{!! Form::label('storyrole', 'Storyrole:') !!}
			{!! Form::text('storyrole') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}