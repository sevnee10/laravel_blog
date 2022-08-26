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
                <p>{!!  Str::words($post->content,40) !!}</p>
            </div>
            <a class="entry__more-link" href="{{url('/posts/'.$post->id)}}">Learn More</a>
        </div> <!-- end entry__text -->
    </article> <!-- end article -->
    @endforeach
</div> <!-- end brick-wrapper -->

{!! $posts->links() !!}
</div> <!-- end masonry -->

{{-- @push('script')
    <script>
        $(document).ready(function(){
        $(document).on('click', '.page-link', function(event){
            event.preventDefault(); 
            var page = $(this).attr('href').split('page=')[1];
            fetchData(page);
        });

        function fetchData(page){
            $.ajax({
                url: '/home?page=' + page
            }).done(function(data){
                $('.s-bricks').html(data);
            });
        }
        });
    </script>
@endpush --}}