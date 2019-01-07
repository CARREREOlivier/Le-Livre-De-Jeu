<div class="modal-content">
	{!! Form::open(array('route' => 'gameturn.create', 'method' => 'POST')) !!}
	<div class="modal-header">
		<h4 class="modal-title"><i class="fas fa-pen-alt"></i>Ajouter un tour </h4>
		<button class="close" aria-hidden="true" type="button" data-dismiss="modal">×</button>
	</div>
	<div class="modal-body">

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
				{!! Form::label('title', 'Title:') !!}
				{!! Form::text('title') !!}
			</li>
			<li>
				{!! Form::label('description', 'Description:') !!}
				{!! Form::textarea('description') !!}
			</li>
		</ul>


	</div>
	<div class="modal-footer">
		<button class="btn btn-info" type="button" data-dismiss="modal">Annuler</button>
		{!! Form::submit('Ajouter', array('class'=>'btn btn-primary')) !!}
		{!! Form::close() !!}
	</div>
</div>