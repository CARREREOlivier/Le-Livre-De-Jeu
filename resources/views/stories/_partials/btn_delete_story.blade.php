<form action="{{route('story.delete',$story->slug)}}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button class="btn btn-danger lined thin" data-toggle="tooltip" data-placement="top" title="Tout effacer. Attention, tous les posts seront perdus!"><i class="fas fa-trash-alt"></i></button>
</form>