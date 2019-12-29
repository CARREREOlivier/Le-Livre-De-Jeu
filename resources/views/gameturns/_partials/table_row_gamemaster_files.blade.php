@if($gamemaster_files != null)
    @foreach($gamemaster_files as $file)
        <tr>
            <td>
                <p>{!! $file->original_name !!}</p>
            </td>
            <td><a href="/uploads/{{$file->filename}}" download="{{$file->original_name}}">
                    <i class="fas fa-download"></i></a></td>

            <td>@auth @if(Auth::User()->id == $gameSession->user_id) &nbsp;&nbsp;&nbsp; <a
                        class="delete-link"
                        href="{{route('upload.delete_file',$file->id)}}"
                        onclick="confirmDeletion()"> <i class="fas fa-trash-alt"></i></a></td>
            @endif
            @endauth
        </tr>
    @endforeach
@else
    <p>pas de fichier associé</p>
@endif