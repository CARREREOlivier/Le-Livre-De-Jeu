@if($stories !=null)
    @foreach($stories->reverse() as $story)
        <div class="row strip white-bg">

            <div class="col-md-4 box-left">
                <div class="blue-bg vignette full-height">
                    <div class="evenboxinner-turn">

                    {!! $story->created_at !!}

                    </div>
                    <br/>

                    {!! $story->title !!}

                    @auth
                        @if(Auth::user()->status=='Admin')
                            <hr>
                            Edit AAR
                            Effacer AAR
                        @endif
                    @endauth

                </div>
            </div>


            <div class="col-md-8 box-right">
                <div class="green-bg vignette full-height">
                    {!! $story->summary !!}
                    bouton lire AAR
                </div>
            </div>
        </div>
    @endforeach
@endif