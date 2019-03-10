{{ Form::open(array('method' => 'DELETE', 'route' => array('info.destroy',$n->slug))) }}
<button class="btn btn-danger lined thin"><i class="fas fa-trash-alt"></i></button>
{{ Form::close() }}