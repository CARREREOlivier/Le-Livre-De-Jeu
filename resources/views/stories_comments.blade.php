{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('user_id', 'User_id:') !!}
			{!! Form::text('user_id') !!}
		</li>
		<li>
			{!! Form::label('story_post_id', 'Story_post_id:') !!}
			{!! Form::text('story_post_id') !!}
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