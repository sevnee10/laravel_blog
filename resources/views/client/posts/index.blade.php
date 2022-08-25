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
                <article class="s-content__entry format-standard">

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
                        </div> <!-- end s-entry__entry-content -->

                        <div class="s-content__entry-meta">
                            @foreach ($users as $user)
                            @if($post->user_id == $user->id)
                            <div class="entry-author meta-blk">
                                <div class="author-avatar">
                                    <img class="avatar" src="{{asset('frontend/images/avatars/user-06.jpg')}}" alt="">
                                </div>
                                <div class="byline">
                                    <span class="bytext">Posted By</span>
                                    <a href="#0">{{$user->name}}</a>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            <div class="meta-bottom">
                                @foreach ($categories1 as $cate)
                                @if($post->category_id == $cate->id)
                                    <div class="entry-cat-links meta-blk">
                                        <div class="cat-links">
                                            <span>Categories</span> 
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
                {{-- @endforeach --}}
            @endforeach
            </div> <!-- end column -->
        </div> <!-- end row -->


        <!-- comments
        ================================================== -->
        <div class="comments-wrap">

            <div id="comments" class="row">
                <div class="column large-12">

                    <h3>5 Comments</h3>

                    <!-- START commentlist -->
                    <ol class="commentlist">

                        <li class="depth-1 comment">

                            <div class="comment__avatar">
                                <img class="avatar" src="{{asset('frontend/images/avatars/user-01.jpg')}}" alt="" width="50" height="50">
                            </div>

                            <div class="comment__content">

                                <div class="comment__info">
                                    <div class="comment__author">Itachi Uchiha</div>

                                    <div class="comment__meta">
                                        <div class="comment__time">Oct 05, 2020</div>
                                        <div class="comment__reply">
                                            <a class="comment-reply-link" href="#0">Reply</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="comment__text">
                                <p>Adhuc quaerendum est ne, vis ut harum tantas noluisse, id suas iisque mei. Nec te inani ponderum vulputate,
                                facilisi expetenda has et. Iudico dictas scriptorem an vim, ei alia mentitum est, ne has voluptua praesent.</p>
                                </div>

                            </div>

                        </li> <!-- end comment level 1 -->
                    </ol>
                    <!-- END commentlist -->

                </div> <!-- end col-full -->
            </div> <!-- end comments -->


            <div class="row comment-respond">

                <!-- START respond -->
                <div id="respond" class="column">

                    <h3>
                    Add Comment 
                    <span>Your email address will not be published.</span>
                    </h3>

                    <form name="contactForm" id="contactForm" method="post" action="" autocomplete="off">
                        <fieldset>

                            <div class="form-field">
                                <input name="cName" id="cName" class="h-full-width h-remove-bottom" placeholder="Your Name" value="" type="text">
                            </div>

                            <div class="form-field">
                                <input name="cEmail" id="cEmail" class="h-full-width h-remove-bottom" placeholder="Your Email" value="" type="text">
                            </div>

                            <div class="form-field">
                                <input name="cWebsite" id="cWebsite" class="h-full-width h-remove-bottom" placeholder="Website" value="" type="text">
                            </div>

                            <div class="message form-field">
                                <textarea name="cMessage" id="cMessage" class="h-full-width" placeholder="Your Message"></textarea>
                            </div>

                            <br>
                            <input name="submit" id="submit" class="btn btn--primary btn-wide btn--large h-full-width" value="Add Comment" type="submit">

                        </fieldset>
                    </form> <!-- end form -->

                </div>
                <!-- END respond-->

            </div> <!-- end comment-respond -->

        </div> <!-- end comments-wrap -->


    </section> <!-- end s-content -->

@endsection