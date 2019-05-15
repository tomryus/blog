@extends('layouts.frontend')
@section('content')
@push('nav')
    <ul class="nav-menu nav navbar-nav">
        @php
            $no = 1;
        @endphp
        @foreach ($parsing as $item)
            @if($item->article_count!==0)
                <li class="cat-{{$no}}"><a href="{{route('front.category', $item->slug)}}">{{$item->category_name}}</a></li>
            @endif
        @php
            $no++;
        @endphp
        @endforeach
    </ul>
@endpush

@push('nav1')
        @foreach ($parsing as $item)
            @if($item->article_count!==0)
                <li class="cat-{{$no}}"><a href="{{route('front.category', $item->slug)}}">{{$item->category_name}}</a></li>
            @endif
        @endforeach
@endpush


<!-- section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Post content -->
            <div class="col-md-8">
                <div class="section-row sticky-container">
                    <div class="main-post">
                        <h3>{{$post->title}}</h3>
                        <figure class="figure-img">
                            <img class="img-responsive" src="{{asset('storage/images/article/'. $post->image )}}" alt="">
                            <figcaption>{{$post->short_description}}</figcaption>
                        </figure>
                        {!! $post->content !!}
                    </div>
                    <div class="post-shares sticky-shares">
                        <a href="#" class="share-facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="share-twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="share-google-plus"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="share-pinterest"><i class="fa fa-pinterest"></i></a>
                        <a href="#" class="share-linkedin"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-envelope"></i></a>
                    </div>
                </div>


                <!-- author -->
                <div class="section-row">
                    <div class="post-author">
                        <div class="media">
                            <div class="media-left">
                                <img class="media-object" src="{{asset('front/img/author.png')}}" alt="">
                            </div>
                            <div class="media-body">
                                <div class="media-heading">
                                    <h3>Tommy Roy Sirait</h3>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                <ul class="author-social">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /author -->
            </div>
            <!-- /Post content -->

            <!-- aside -->
            <div class="col-md-4">
                <!-- post widget -->
                <div class="aside-widget">
                    <div class="section-title">
                        <h2>Featured Posts</h2>
                    </div>
                    <div class="post post-thumb">
                        <a class="post-img" href="blog-post.html"><img src="{{asset('front/img/post-2.jpg')}}" alt=""></a>
                        <div class="post-body">
                            <div class="post-meta">
                                <a class="post-category cat-3" href="#">Jquery</a>
                                <span class="post-date">March 27, 2018</span>
                            </div>
                            <h3 class="post-title"><a href="blog-post.html">Ask HN: Does Anybody Still JQuery?</a>
                            </h3>
                        </div>
                    </div>


                </div>
                <!-- /post widget -->

                <!-- catagories -->
                <div class="aside-widget">
                    <div class="section-title">
                        <h2>Catagories</h2>
                    </div>
                    <div class="category-widget">
                        <ul>
                            
                            @foreach ($parsing as $item)
                                @if($item->article_count!==0)
                                    <li><a href="{{route('front.category', $item->id)}}" class="cat-1">{{$item->category_name}}<span>{{$item->article_count}}</span></a></li>
                                @endif
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
                <!-- /catagories -->
            </div>
            <!-- /aside -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->

@endsection