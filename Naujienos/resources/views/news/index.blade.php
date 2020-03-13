
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
    <div class="row">
        <div class="col-9 row justify-content-around">
            @foreach($news as $new)
                <p><i class="far fa-comment"></i></p>
                <div class="col-5 kortele">
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
                <div style="width: fit-content; margin: 0px auto">
                    {{$news->links()}}
                </div>
            </div>
        </div>
        <div class="col-3 right_info">
            <h4>Top 3 Skaitomiausi</h4>
            <div style="padding: 10px">
                @for($i = 0; $i < 3; $i++)
                    <a href="">
                        <p>{{$views[$i]['title']}} ({{$views[$i]['views']}})</p>
                    </a>
                @endfor
            </div>
            <h4>Top autoriai</h4>
            <div class="authors">
                @foreach($users as $user)
                    <p style="padding-left: 8px; font-size: 16px"><b>{{$user->name}} </b>({{$user->news->count()}})</p>
                    <div style="max-height: 250px; overflow-y: scroll; margin-bottom: 20px">
                        @foreach($user->news as $item)
                            <p style="padding-left: 8px; margin-bottom: 8px">
                                <a href="{{route('news.show', $item->id)}}">{{$item->title}}</a>
                            </p>
                            <hr>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        @section('asd')
            <p>sdaf</p>
            @endsection
    </div>
@endsection
