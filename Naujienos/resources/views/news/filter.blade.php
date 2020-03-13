
@extends('layouts.app')

@section('content')
    <div style="margin-top: 6px" class="container">
        <nav class="categories_nav">
            @foreach($categories as $item)
                <div class="navbar-nav">
                    <a class="nav_links" href="{{route('news.filter', $item->id)}}">{{$item->name}}</a>
                </div>
            @endforeach

        </nav>
    </div>
    <div class="row justify-content-around">
        @foreach($news as $new)
            <div class="col-3 kortele">
                <a style="text-decoration: none" href="{{route('news.show', $new->id)}}">
                    <div class="img"><img style="width: 100%; height: 100%" src="https://img.freepik.com/free-vector/blue-breaking-news-tv-background_1017-14201.jpg?size=626&ext=jpg" alt=""></div>
                    <div class="card-body">
                        <p style="color: black" class="card-text"><b>{{$new->title}} <span style="color: red"> ({{$new->comments->count()}})</span></b></p>
                        <p style="margin-bottom: 0px">{{$new->category->name}}</p>
                    </div>
                </a>
            </div>
        @endforeach
        <div class="col-12">
{{--            <div style="width: fit-content; margin: 0px auto">--}}
{{--                {{$news->links()}}--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
