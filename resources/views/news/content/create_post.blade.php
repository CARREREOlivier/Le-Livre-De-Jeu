<div class="row row-title">
    <div class="title big">News : Message</div>
</div>
{{Form::open(array('route' => 'infopost.store', 'method' => 'POST'))}}
{!! csrf_field() !!}
{{Form::hidden('info_id', $info_id)}}
{{Form::label('text', 'Message :')}}
{{Form::textarea('text')}}

{{Form::submit('Publier',['class'=>'btn btn-secondary lined thin'])}}
{{Form::close()}}