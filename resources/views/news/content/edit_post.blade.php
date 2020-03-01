{!! Form::model($post, array('route' => array('infopost.update', $post->id),'method' => 'PUT')) !!}
{!! csrf_field() !!}
<div class="row strip pencil">
    <div class="vignette red-bg">
        <div class="row">
            {{Form::label('text','Texte : ')}}
            {{Form::textarea('text',$post->title,['required'=>'required','id'=>'editNewsPostText'])}}
            <br/>
            {{Form::submit('Mettre à jour',['class'=>'btn btn-secondary lined thin float-right'])}}
        </div>
    </div>
</div>
{{Form::close()}}

<script>
    CKEDITOR.replace( 'editNewsPostText' );
</script>