<div class="row row-title"><h1 class="big title">Chapitre d'AAR</h1></div>
{{Form::open(array('route' => 'story.store.post', 'method' => 'POST'))}}
{!! csrf_field() !!}
<div class="row strip pencil">
    <div class="vignette red-bg">
        <div class="row">
            <div class="col-2">
                {!! Form::hidden('story_id', $story_id) !!}
                {!! Form::hidden('co_author', 'none') !!}
                {!! Form::hidden('visible_by', 'all') !!}
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
        {{Form::label('text','Texte : ')}}
        {{Form::textarea('text','',['id'=>'createStoryPostText'])}}
        <br/>
        {{Form::submit('Créer l\'entrée',['class'=>'btn btn-secondary lined thin float-right'])}}
    </div>
</div>
{{Form::close()}}


<script>
    CKEDITOR.replace( 'createStoryPostText' );
</script>