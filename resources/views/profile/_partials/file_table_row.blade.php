<tr>
    <td><img src="/uploads/{{ $document->resized_name }}"></td>
    <td>{{$document->created_at}}</td>
    <td>{{ $document->original_name}}</td>
    <td><a href="{{URL::to("/")."/uploads/".$document->filename}}"
           download="{{$document->original_name}}" role="button"
           class="btn btn-secondary lined thin"><i
                    class="fas fa-download"></i></a> @include('profile._partials.delete_file')
    </td>
</tr>