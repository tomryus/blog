@extends('layouts.frontend')
@push('nav')
    <ul class="nav-menu nav navbar-nav">
        @php
            $no = 1;
        @endphp
        @foreach ($count as $item)
            @if($item->article_count!==0)
            
                <li class="cat-{{$no}}"><a href="{{route('front.category', $item->id)}}">{{$item->category_name}}</a></li>
            @endif
        
        @php
            $no++;
        @endphp
        @endforeach
    </ul>
@endpush
@push('nav1')
        @foreach ($count as $item)
            @if($item->article_count!==0)
                <li class="cat-{{$no}}"><a href="{{route('front.category', $item->id)}}">{{$item->category_name}}</a></li>
            @endif
        @endforeach
@endpush
@section('content')
<!-- section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-8">
                    @foreach ($post as $item)
                <div class="row">

                    <!-- post -->
                    <div class="col-md-12">
                        <div class="post post-row">
                            <a class="post-img" href="{{route('front.blogpost', $item->slug)}}"><img src="{{asset('storage/images/article/'. $item->image)}}" alt=""></a>
                            <div class="post-body">
                                <div class="post-meta">
                                    <a class="post-category cat-2" href="{{route('front.category', $item->category_id)}}">{{$item->Category->category_name}}</a>
                                    <span class="post-date">{{$item->created_at->diffForHumans()}}</span>
                                </div>
                                <h3 class="post-title"><a href="{{route('front.blogpost', $item->slug)}}">{{$item->title}}</a>
                                </h3>
                                <p>{{$item->short_description}}</p>
                            </div>
                        </div>
                    </div>
                    <!-- /post -->
                </div>
                @endforeach
            </div>

            <div class="col-md-4">
                <!-- post widget -->
                <div class="aside-widget">
                    <div class="section-title">
                        <h2>Most Read</h2>
                    </div>

                    <div class="post post-widget">
                        <a class="post-img" href="blog-post.html"><img src="{{asset('front/img/widget-1.jpg')}}" alt=""></a>
                        <div class="post-body">
                            <h3 class="post-title"><a href="blog-post.html">Tell-A-Tool: Guide To Web Design And
                                    Development
                                    Tools</a></h3>
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
                                @foreach ($count as $item)
                                    @if($item->article_count!==0)
                                    <li><a href="{{route('front.category', $item->id)}}" class="cat-1">{{$item->category_name}}<span>{{$item->article_count}}</span></a></li>    
                                    @endif
                                @endforeach
                        </ul>
                    </div>
                </div>
                <!-- /catagories -->
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->
@endsection