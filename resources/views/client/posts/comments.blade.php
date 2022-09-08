@foreach ($comments as $comm)
    <!-- START commentlist -->
    <ol class="commentlist">

        <li class="depth-1 comment">

            <div class="comment__avatar">
                <img class="avatar" src="{{asset('frontend/images/avatars/user-01.jpg')}}" alt="" width="50" height="50">
            </div>

            <div class="comment__content">

                <div class="comment__info">
                    <div class="comment__author">{{$comm->user->name}}</div>
                    <div class="comment__meta">
                        <div class="comment__time">{{$comm->created_at}}</div>
                    </div>
                </div>
                <div class="comment__text">
                    <p>{{$comm->message}}</p>
                </div>
                {{-- @if(Auth::check()) --}}
                    
                <div class="comment__reply">
                    <a class="btn-show-reply-form" data-id="{{$comm->id}}" href="#0">Reply</a>
                </div>
                @foreach($comm->replies as $reply)
                    <div class="comment__avatar reply-block">
                        <img class="avatar" src="{{asset('frontend/images/avatars/user-08.jpg')}}" alt="" width="50" height="50">
                    </div>
                    <div class="comment__info">
                        <div class="comment__author">{{$reply->user->name}}</div>
                        <div class="comment__meta ">
                            <div class="comment__time">{{$reply->created_at}}</div>
                        </div>
                    </div>
                    <div class="comment__text">
                    <p>{{$reply->message}}</p>
                {{-- @else
                    <button type="button" class="btn btn-outline-dark btn--small rp_cm" data-bs-toggle="modal" data-bs-target="#modalId">
                        Login to reply comment
                    </button> --}}
                @endforeach
                {{-- @endif --}}
                <form action="" method="POST" style="display: none" class="formReply form-reply-{{$comm->id}}">
                    <div class="mb-3">
                        <textarea style="resize:none" id="msg-reply-content-{{$comm->id}}" name="reply_message" class="reply-message" required="required" placeholder="Your Reply Message"></textarea>
                    </div>
                    <button type="submit" data-id="{{$comm->id}}" class="btn btn--small btn-success btn-reply-comment">Send</button>
                </form>
            </div>
        </li> <!-- end comment level 1 -->
    </ol>
    <!-- END commentlist -->
@endforeach