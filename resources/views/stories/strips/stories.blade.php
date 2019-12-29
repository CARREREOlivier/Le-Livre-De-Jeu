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
                <!--Collapse-->
                    <p>
                        <button id="see-stories-posts" class="btn btn-primary lined thin" type="button" data-toggle="collapse" data-toggle-secondary="Close"
                                data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" onclick="changeStoryCollapsibleText()">
                            Voir la liste des posts
                        </button>
                    </p>

                    <div class="collapse" id="collapseExample">
                        @foreach($storyPosts as $storyPost)
                            <div class="col-md-12 box-left">
                                <div class="yellow-bg story-posts-vignette word-wrap:break-word ">
                                    @if($storyPost->story_id == $story->id)
                                        <div class="evenboxinner-turn">{!! $storyPost->created_at !!} </div>
                                        <h4>{!! $storyPost->title!!}</h4>
                                        <p>Par {!! $storyPost->username !!}
                                            et {!! $storyPost->co_author !!}
                                            visible par  {!! $storyPost->visible_by !!}</p>
                                       @include('stories._partials.btn_read_post')
                                        <a href="#">edit {{$storyPost->id}}</a>
                                        <a href="#">delete {{$storyPost->id}}</a>
                                    @endif
                                </div>
                            </div>
                    <br/>


                        @endforeach

                    </div>

                    @include('stories._partials.btn_add_post')
                    @include('stories._partials.btn_read_story')

                </div>
            </div>
        </div>
    @endforeach
@endif