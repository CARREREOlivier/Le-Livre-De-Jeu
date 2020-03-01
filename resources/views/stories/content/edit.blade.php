
<div class="row row-title"><h1 class="big title">MAJ Titre/Introduction</h1></div>
{!! Form::model($story, array('route' => array('story.update', $story->slug),'method' => 'PUT')) !!}
{!! csrf_field() !!}

<div class="row strip pencil">
    <div class="vignette red-bg">
        <div class="row">
            <div class="col-2">
                {{Form::label('title','Titre : ')}}
            </div>
            <div class="col-10">
                {{Form::text('title',null,['required'=>'required', 'class'=>'gameSessionTitleInput'])}}
            </div>
        </div>
    </div>
</div>
<div class="row strip pencil">
    <div class="vignette green-bg">
        {{Form::label('description','Introduction : ')}}
        {{Form::textarea('description','',['id'=>'editStoryDescription'])}}
        <br/>
        {{Form::submit('Mettre à jour',['class'=>'btn btn-secondary lined thin float-right'])}}
    </div>
</div>
{{Form::close()}}

<script>
    CKEDITOR.replace( 'editStoryDescription' );
</script>