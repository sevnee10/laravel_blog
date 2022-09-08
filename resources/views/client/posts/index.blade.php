 @extends('layouts.app')
 @section('title','Details Post')
 @section('content')
 <!-- content
    ================================================== -->
    <section class="s-content">

        <div class="row">
            <div class="column large-12">
                @foreach ($posts as $post)
                @if($post->id == $post_id )
                <article class="s-content__entry format-standard" data-post="{{$post->id}}">

                    <div class="s-content__media">
                        <div class="s-content__post-thumb">
                            <img alt="{{$post->ima}}" src="{{asset('assets/storage/'.$post->ima)}}" style="align-items: center">
                        </div>
                    </div> <!-- end s-content__media -->

                    <div class="s-content__entry-header">
                        <h1 class="s-content__title s-content__title--post">{{$post->title}}</h1>
                    </div> <!-- end s-content__entry-header -->

                    <div class="s-content__primary">

                        <div class="s-content__entry-content">
                            {!! $post->content !!}
                            <small class="float-right">
                                @auth
                                    <i class="fal fa-heart press {{$post->likes->contains('user_id',auth()->id()) ? 'heart' : ''}} float-right">{{$post->likes->count()}}</i>
                                @else
                                    <i class="fal fa-heart press float-right">{{$post->likes->count()}}</i>
                                @endauth
                            </small>
                        </div> <!-- end s-entry__entry-content -->                   
                        <div class="s-content__entry-meta">
                            <div class="entry-author meta-blk">
                                <div class="author-avatar">
                                    <img class="avatar" src="{{asset('frontend/images/avatars/user-06.jpg')}}" alt="">
                                </div>
                                @foreach ($users as $user)
                                    @if($user->id==$post->user_id)
                                        <div class="byline">
                                            <span class="bytext">Posted By</span>
                                            <a href="#0">{{$user->name}}</a>
                                        </div>
                                    @endif
                                @endforeach       
                            </div>

                            @foreach ($categories1 as $cate)
                                @if($cate->id==$post->category_id)
                                    <div class="meta-bottom">
                                        <div class="entry-cat-links meta-blk">
                                            <div class="cat-links">
                                                <span>In</span> 
                                                <a href="#0">{{$cate->name}}</a>
                                            </div>

                                            <span>On</span>
                                            {{$post->created_at}}
                                        </div>
                                        <div class="entry-tags meta-blk">
                                            <span class="tagtext">Tags</span>
                                            <a href="#">{{$cate->slug}}</a>
                                        </div>
                                        
                                    </div>
                                @endif
                            @endforeach

                        </div> <!-- s-content__entry-meta -->

                        <div class="s-content__pagenav">
                            <div class="prev-nav">
                                <a href="#" rel="prev">
                                    <span>Previous</span>
                                    Tips on Minimalist Design 
                                </a>
                            </div>
                            <div class="next-nav">
                                <a href="#" rel="next">
                                    <span>Next</span>
                                    A Practical Guide to a Minimalist Lifestyle.
                                </a>
                            </div>
                         </div> <!-- end s-content__pagenav -->

                    </div> <!-- end s-content__primary -->
                    
                </article> <!-- end entry -->
                @endif
            @endforeach
            </div> <!-- end column -->    
        </div> <!-- end row -->

        <!-- comments
        ================================================== -->
        <div class="comments-wrap">
            <div id="comments" class="row">
                <div id="comment-list" class="column large-12">
                    <h3>All Comments</h3>
                    @include('client.posts.comments')
                </div> <!-- end col-full -->
            </div> <!-- end comments -->
        
            <div class="row comment-respond">
        
                <!-- START respond -->
                <div id="respond" class="column">
        
                    <h3> Add Comment </h3>
                    @if(Auth::check())
                        <!-- start form -->
                        <form name="contactForm" id="contactForm" method="post" action="" autocomplete="off">
                            <fieldset>
                                <div class="message form-field">
                                    <textarea name="cMessage" id="msg-content" class="h-full-width" required="required" placeholder="Your Message"></textarea>
                                </div>
                                <br>
                                <button id="btn-comment" class="btn btn--primary btn-wide btn--large h-full-width" type="button">Add Comment</button>
                            </fieldset>
                        </form> 
                        <!-- end form -->
                    @else
                        <button type="button" class="btn btn-outline-dark btn--small cm" data-bs-toggle="modal" data-bs-target="#modalId">
                            Login to comment
                        </button>
                    @endif
                </div>
                <!-- END respond-->
        
            </div> <!-- end comment-respond -->
        
        </div> <!-- end comments-wrap -->
        
    </section> <!-- end s-content -->
    <!--  Modal trigger button  -->
    
    
    <!-- Modal Body-->
    <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Login Now!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="error"></div>
                    <br>
                    <form method="POST" action="">
                        <div class="form-group mt-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label class="form-control-placeholder" for="username">Email</label>
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <label class="form-control-placeholder" for="password">Password</label>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <button type="button" id="btn-login" class="btn btn--small btn-outline-success">Login</button>
                        </div>
                        <div class="text-center">
                            <p>or sign up with:</p>
                            <button type="button" class="btn btn-link btn-floating mx-1">
                                <i class="fab fa-facebook-f"></i>
                            </button>
                            <button type="button" class="btn btn-link btn-floating mx-1">
                                <i class="fab fa-google"></i>
                            </button>       
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js_post')
    <script>
        var _token = '{{ csrf_token() }}';
        var _commentUrl = '{{route("ajax-comment.ajax_comment" , $post_id)}}';
        $('#btn-comment').on('click',function(e){
               e.preventDefault();
               let message = $('#msg-content').val();
               $.ajax({
                  url:_commentUrl,
                  type:"POST",
                  data:{
                     message:message,
                     _token:_token,
                  },
                  success:function(response){
                     if(response.error){
                        toastr.error(response.error);
                     }else{
                        toastr.success('Add comment successfully!');
                        $('#msg-content').val('');
                        $('#comment-list').html(response);
                     }
                  }
               });
            });   
        $(document).on('click','.btn-show-reply-form',function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var form_reply = ('.form-reply-') + id;
            var comment_reply_id = '#msg-reply-content-' +id;
            var msgReply = $(comment_reply_id).val();
            $('.formReply').slideUp();
            $(form_reply).slideDown();    
            $.ajax({

            });
        });
        $(document).on('click','.btn-reply-comment',function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var comment_reply_id = '#msg-reply-content-' +id;
            var msgReply = $(comment_reply_id).val();  
            var form_reply = ('.form-reply-') + id;

            $.ajax({
                url:_commentUrl,
                type:"POST",
                data:{
                    message:msgReply,
                    reply_id:id,
                    _token:_token,
                },
                success:function(response){
                    if(response.error){
                        toastr.error(response.error);
                    }else{
                        toastr.success('Add comment successfully!');
                        $('.reply-message').val('');
                        $('#comment-list').html(response);
                    }
                }
            });
        });
    </script>
@endsection
