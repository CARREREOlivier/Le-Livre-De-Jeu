<div class="modal-content">
	{!! Form::open(array('route' => 'gameturn.store', 'method' => 'POST')) !!}
	<div class="modal-header">
		<h4 class="modal-title"><i class="fas fa-pen-alt"></i>Ajouter un tour </h4>
		<button class="close" aria-hidden="true" type="button" data-dismiss="modal">×</button>
	</div>
	<div class="modal-body">

		<ul>
				{!! Form::hidden('gamesessions_id',$gameSession->id) !!}

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