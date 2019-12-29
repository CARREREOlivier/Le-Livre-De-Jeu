<!--Upload system in case of failure of first one-->

{{ Form::open(array('url' => '/file-respud', 'files' => 'true'))}}
{{ csrf_field() }}
{{Form::label('Fichier à uploader')}}
{{Form::hidden('category', "gameturns")}}
{{Form::hidden('entity_id', $gameTurn->id)}}
{{Form::hidden('user_id',$gameSession->user_id)}}
{{Form::file('file')}}
{{Form::submit('Envoyer')}}
{{Form::close()}}
