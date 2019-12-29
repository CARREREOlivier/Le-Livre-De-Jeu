@if($news !=null)
    @foreach($news->reverse() as $n)
        <div class="row strip white-bg">

            <div class="col-md-4 box-left">
                <div class="blue-bg vignette full-height">
                    <div class="evenboxinner-turn">

                    {!! $n->created_at !!}

                    </div>
                    <br/>

                    {!! $n->title !!}

                    @auth
                        @if(Auth::user()->status=='Admin')
                            <hr>
                            @include('news._partials.btn_edit_news')
                            @include('news._partials.btn_delete_news')
                        @endif
                    @endauth

                </div>
            </div>


            <div class="col-md-8 box-right">
                <div class="green-bg vignette full-height">
                    {!! $n->summary !!}
                    @include('news._partials.btn_read_news')
                </div>
            </div>
        </div>
    @endforeach
@endif