@extends('layouts.app')
@section('title','Home Page')

@section('content')
            <!-- hero
    ================================================== -->
    <section id="hero" class="s-hero">
        <div class="s-hero__slider">

            <div class="s-hero__slide">

                <div class="s-hero__slide-bg" style="background-image: url('frontend/images/imasection.jpg');"></div>

                <div class="row s-hero__slide-content animate-this">
                    <div class="column">
                        <div class="s-hero__slide-meta">
                            <span class="cat-links">
                                <a href="#">Work</a>
                            </span>
                            <span class="byline"> 
                                Posted by 
                                <span class="author">
                                    <a href="#">Tuan Anh</a>
                                </span>
                            </span>
                        </div>
                        <h1 class="s-hero__slide-text">
                            <a href="#">
                                Minimalism: The Art of Keeping It Simple.
                            </a>
                        </h1>
                    </div>
                </div>

            </div> <!-- end s-hero__slide -->

            <div class="s-hero__slide">

                <div class="s-hero__slide-bg" style="background-image: url('frontend/images/ima3.avif');"></div>

                <div class="row s-hero__slide-content animate-this">
                    <div class="column">
                        <div class="s-hero__slide-meta">
                            <span class="cat-links">
                                <a href="#">Health</a>
                                <a href="#">Lifestyle</a>
                            </span>
                            <span class="byline"> 
                                Posted by 
                                <span class="author">
                                    <a href="#">Tuan Anh</a>
                                </span>
                            </span>
                        </div>
                        <h1 class="s-hero__slide-text">
                            <a href="#">
                                10 Reasons Why Being in Nature Is Good For You.
                            </a>
                        </h1>
                    </div>
                </div>

            </div> <!-- end s-hero__slide -->

        </div> <!-- end s-hero__slider -->

        <div class="s-hero__social hide-on-mobile-small">
            <p>Follow</p>
            <span></span>
            <ul class="s-hero__social-icons">
                <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
        </div> <!-- end s-hero__social -->

        <div class="nav-arrows s-hero__nav-arrows">
            <button class="s-hero__arrow-prev">
                <svg viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" width="15" height="15"><path d="M1.5 7.5l4-4m-4 4l4 4m-4-4H14" stroke="currentColor"></path></svg>
            </button>
            <button class="s-hero__arrow-next">
               <svg viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" width="15" height="15"><path d="M13.5 7.5l-4-4m4 4l-4 4m4-4H1" stroke="currentColor"></path></svg>
            </button>
        </div> <!-- end s-hero__arrows -->

    </section> <!-- end s-hero -->
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
                                </div>
                            </div>
                            <div class="entry__excerpt">
                                <p>{!!  Str::words($post->content,20) !!}</p>
                            </div>
                            <a class="entry__more-link" href="{{url('/posts/'.$post->id)}}">Learn More</a>
                        </div> <!-- end entry__text -->
                    </article> <!-- end article -->
                    @endforeach
                </div> <!-- end brick-wrapper -->
                <div id="paginate">
                    {!! $posts->links() !!}
                </div>
            </div> <!-- end masonry -->
    
        </div> <!-- end s-bricks -->
    </section> <!-- end s-content -->    
@endsection