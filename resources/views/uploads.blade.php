{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('filename', 'Filename:') !!}
			{!! Form::textarea('filename') !!}
		</li>
		<li>
			{!! Form::label('resized_name', 'Resized_name:') !!}
			{!! Form::textarea('resized_name') !!}
		</li>
		<li>
			{!! Form::label('original_name', 'Original_name:') !!}
			{!! Form::textarea('original_name') !!}
		</li>
		<li>
			{!! Form::label('user_id', 'User_id:') !!}
			{!! Form::text('user_id') !!}
		</li>
		<li>
			{!! Form::label('category', 'Category:') !!}
			{!! Form::text('category') !!}
		</li>
		<li>
			{!! Form::label('entity_id', 'Entity_id:') !!}
			{!! Form::text('entity_id') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}