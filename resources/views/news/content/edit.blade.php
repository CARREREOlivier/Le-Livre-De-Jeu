{!! Form::model($news, array('route' => array('info.update', $news->id),'method' => 'PUT')) !!}
{!! csrf_field() !!}
<div class="row strip pencil">
    <div class="vignette red-bg">
        <div class="row">
            <div class="col-2">
                {{Form::label('title','Titre : ')}}
            </div>
            <div class="col-10">
                {{Form::text('title',$news->title,['required'=>'required', 'class'=>'gameSessionTitleInput'])}}
            </div>
        </div>
    </div>
</div>
<div class="row strip pencil">
    <div class="vignette green-bg">
        {{Form::label('summary','Résumé : ')}}
        {{Form::textarea('summary', $news->summary)}}
        <br/>
        {{Form::submit('Mettre à jour',['class'=>'btn btn-secondary lined thin float-right'])}}
    </div>
</div>
{{Form::close()}}

