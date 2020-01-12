<p>
    <a class="btn btn-secondary lined thin float-right" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" title="ajouter un commentaire">
        <i class="fas fa-comments"></i>
    </a>
</p>
<div class="collapse" id="collapseExample">
    <div class="card card-body">
        {!!  Form::open(array('route'=>'story_post.add.comment','method' => 'POST')) !!}
        {!! csrf_field() !!}
        {{Form::label('text','Commentaire: ')}}
        {{Form::textarea('text')}}
        {{Form::hidden('story_post_id',$story_post->id)}}
        {{Form::submit('Envoyer',['class'=>'btn btn-secondary lined thin float-right'])}}
        {!! Form::close() !!}
    </div>
</div>