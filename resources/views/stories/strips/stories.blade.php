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
                        @if(Auth::user()->status=='Admin' OR Auth::user()->id == $story->user_id)
                            <hr>
                            @include('stories._partials.btn_edit_story')
                            @include('stories._partials.btn_delete_story')
                            @include('stories._partials.btn_manage_permissions_story')
                        @endif
                    @endauth

                </div>
            </div>


            <div class="col-md-8 box-right">
                <div class="green-bg vignette full-height">
                    {!! $story->description !!}
                    @include('stories._partials.btn_read_story')

                </div>
            </div>
        </div>
    @endforeach
@endif