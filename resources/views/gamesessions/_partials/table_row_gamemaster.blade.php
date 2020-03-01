@foreach($uploadedFiles as $uploadFile)

    @if($uploadFile->user_id== $gamemaster->first()->getusers->id)
        <tr style="font-size: 75%">
            <td>@include('utils.date_french',['date'=>$uploadFile->created_at])</td>
            @auth
                @if(Auth::User()->id == $gamemaster->first()->getusers->id or $gameTurns->last()->locked == true )
                    <td><a href="/uploads/{{$uploadFile->filename}}"
                           download="{{$uploadFile->original_name}}"><i class="fas
                                                                                                  fa-download"></i>{{$uploadFile->original_name}}
                        </a></td>
                    <td>
                        @if(Auth::User()->id == $gamemaster->first()->getusers->id)
                            @include('gamesessions._partials.delete_upload', ['file_id'=>$uploadFile->id])</td>
                        @endif
                @else
                    <td>
                        <i class="fas fa-download"></i>{{$uploadFile->original_name}}
                    </td>
                @endif

            @endauth
            @guest
                <td>
                    <i class="fas fa-download"></i>{{$uploadFile->original_name}}
                </td>
            @endguest

        </tr>
    @endif
@endforeach