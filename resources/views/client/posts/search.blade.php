@extends('layouts.app')
@section('title','Result Search')
@section('content')
    <section class="s-content s-content--no-top-padding">
        <!-- masonry
        ================================================== -->
        <div class="s-bricks">

            <div class="masonry">
                <div class="bricks-wrapper h-group">
                    <div class="grid-sizer"></div>
                
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    @foreach ($search_post as $search)
                        
                    <article class="brick entry" data-aos="fade-up">
    
                        <div class="entry__thumb">
                            <a href="{{url('/posts/'.$search->id)}}" class="thumb-link">
                                <img src="/assets/thumbnails/{{$search->ima}}" alt="{{$search->title}}">
                            </a>
                        </div> <!-- end entry__thumb -->
    
                        <div class="entry__text">
                            <div class="entry__header">
                                <h1 class="entry__title"><a href="{{url('/posts/'.$search->id)}}">{{$search->title}}</a></h1>
                                
                                <div class="entry__meta">
                                    <span class="byline">By:
                                        @foreach ($users as $user)
                                            @if($search->user_id == $user->id)
                                                <a href="#">{{$user->name}}</a>
                                            @endif
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                            <div class="entry__excerpt">
                                <p>{!!  Str::words($search->content,40) !!}</p>
                            </div>
                            <a class="entry__more-link" href="{{url('/posts/'.$search->id)}}">Learn More</a>
                        </div> <!-- end entry__text -->
                    
                    </article> <!-- end article -->
                    @endforeach

                </div>
            </div> <!-- end masonry -->

        </div> <!-- end s-bricks -->
    </section> <!-- end s-content -->    
@endsection