
<div class="row row-title"><h1 class="big title">Modifier Post d'AAR</h1></div>
{!! Form::model($story_post, array('route' => array('story.update.post', $story_post->slug),'method' => 'PUT')) !!}
{!! csrf_field() !!}

<div class="row strip pencil">
    <div class="vignette red-bg">
        <div class="row">
            <div class="col-2">
                {{Form::label('title','Titre : ')}}
            </div>
            <div class="col-10">
                {{Form::text('title',$story_post->title,['required'=>'required', 'class'=>'gameSessionTitleInput'])}}
            </div>
        </div>
    </div>
</div>
<div class="row strip pencil">
    <div class="vignette green-bg">
        {{Form::label('text','Texte : ')}}
        {{Form::textarea('text',$story_post->text,['required'=>'required','class'=>'gameSessionTitleInput'])}}
        <br/>
        {{Form::submit('Mettre à jour',['class'=>'btn btn-secondary lined thin float-right'])}}
    </div>
</div>
{{Form::close()}}