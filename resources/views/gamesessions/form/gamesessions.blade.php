{!! Form::open(array('route' => 'gamesession.store', 'method' => 'POST')) !!}
{!! csrf_field() !!}
<ul>

		<li>
			{!! Form::label('title', 'Title:') !!}
			{!! Form::text('title') !!}
		</li>
		<li>
			{!! Form::label('game', 'Game:') !!}
			{!! Form::text('game') !!}
		</li>
		<li>
			{!! Form::label('description', 'Description:') !!}
			{!! Form::textarea('description') !!}
		</li>

		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}