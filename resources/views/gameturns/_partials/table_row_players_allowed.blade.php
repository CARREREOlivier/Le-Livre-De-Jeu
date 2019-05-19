@foreach($uploadedFiles as $uploadedFile)
    @foreach($players as $player)
        @if($uploadedFile->user_id == $player->getusers->id)
            <tr>
                <td>
                    {{$uploadedFile->created_at}}
                </td>
                <td>
                    {{$player->getusers->username}}
                </td>
                <td>
                    <a href="/uploads/{{$uploadedFile->filename}}"
                       download="{{$uploadedFile->original_name}}"><i class="fas
                                                                                                  fa-download"></i>{{$uploadedFile->original_name}}
                    </a>

                </td>
                @foreach($orders as $order)
                    @if($order->message != "" and $order->gameturn_id == $gameTurn->id and ($order->user_id ==  $player->getusers->id))

                        <td>
                            <p>{!! $order->message !!}</p>
                        </td>
                    @endif
                @endforeach
            </tr>
            @break
        @endif
    @endforeach
@endforeach