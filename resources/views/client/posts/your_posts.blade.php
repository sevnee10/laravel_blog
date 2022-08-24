@extends('layouts.app')
@section('title','Your Posts')
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
                
                @foreach ($posts as $post)
                    @if($post->user_id == Auth::user()->id)
                        <article style="height: 800px" class="brick entry" data-aos="fade-up">

                            <div class="entry__thumb">
                                <a href="{{url('/posts/'.$post->id)}}" class="thumb-link">
                                    <img src="/assets/thumbnails/{{$post->ima}}" alt="{{$post->title}}">
                                </a>
                            </div> <!-- end entry__thumb -->

                            <div class="entry__text">
                                <div class="entry__header">
                                    <h1 class="entry__title"><a href="{{url('/posts/'.$post->id)}}">{{$post->title}}</a></h1>
                                    
                                    <div class="entry__meta">
                                        <span class="byline">By:
                                            <span class='author'>
                                                @foreach ($users as $user)
                                                @if($post->user_id == $user->id)
                                                    <a href="#">{{$user->name}}</a>
                                                @endif
                                                @endforeach
                                            </span>
                                        </span>
                                        <div class="ic float-end">
                                            <a href="{{url('/your-post/'.$post->id.'/edit')}}"><span style="color: green;"><i class="fas fa-edit"></i></span></a>
                                            <a href="{{url('/your-post/'.$post->id.'/delete')}} " onclick="return confirm('Are you sure delete this data?')"><span style="color: red;"><i class="fas fa-trash"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="entry__excerpt">
                                    <p>{!!  Str::words($post->content,20) !!}</p>
                                </div>
                                <a class="entry__more-link" href="{{url('/posts/'.$post->id)}}">Learn More</a>
                            </div> <!-- end entry__text -->
                        </article> <!-- end article -->
                    @endif
                @endforeach
            </div> <!-- end brick-wrapper -->
            <div id="paginate">
                {!! $posts->links() !!}
            </div>
        </div> <!-- end masonry -->

    </div> <!-- end s-bricks -->
</section> <!-- end s-content -->    
@endsection