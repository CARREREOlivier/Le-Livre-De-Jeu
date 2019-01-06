@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

<!-- Edit GameSession Form -->


{!! Form::model(array(['route' => 'gamesession.update', $gamesession], 'method' => 'PATCH')) !!}
{!! csrf_field() !!}
<ul>

		<li>
			{!! Form::label('title', 'Title:') !!}
			{!! Form::text('title', $gamesession->title) !!}
		</li>
		<li>
			{!! Form::label('game', 'Game:') !!}
			{!! Form::text('game', $gamesession->game) !!}
		</li>
		<li>
			{!! Form::label('description', 'Description:') !!}
			{!! Form::textarea('description', $gamesession->description) !!}
		</li>

		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}