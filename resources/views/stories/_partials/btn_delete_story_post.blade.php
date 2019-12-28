{{ Form::open(array('method' => 'DELETE', 'route' => array('story_post.delete',$story_post->slug))) }}
<button class="btn btn-danger lined thin"><i class="fas fa-trash-alt"></i></button>
{{ Form::close() }}