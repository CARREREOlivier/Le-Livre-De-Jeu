{{ Form::open(array('method' => 'DELETE', 'route' => array('infopost.destroy',$post->id))) }}
<button class="btn btn-danger lined thin"><i class="fas fa-trash-alt"></i></button>
{{ Form::close() }}