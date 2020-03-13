
@extends('layouts.app')
@section('content')
    <div class="content">
        <h4>{{$user->name}}</h4>
        <div class="row">
            <div class="col-3">
                <img style="width: 100%" src="https://religion.columbia.edu/themes/custom/columbia/assets/img/people-default.svg" alt="">
            </div>
            <div class="col-9">
                <p><b>El paštas: </b> {{$user->email}}</p>
                <p><b>Apie mane: </b>{{$user->about_me}}</p>
            </div>
        </div>
        <div style="border-bottom: 3px solid lightseagreen;">
            <h4 style="margin-top: 25px; border-bottom: none; margin-bottom: 5px">Autoriaus naujienos ({{$user->news->count()}})</h4>
        </div>
        @foreach($user->news as $item)
            <div class="author_news">
                <a href="{{route('news.show', $item->id)}}}">
                    <div class="author_news_photo">
                        <img style="width: 100%" src="https://img.freepik.com/free-vector/blue-breaking-news-tv-background_1017-14201.jpg?size=626" alt="">
                    </div>
                    <div class="author_news_info">
                        <h3>{{$item->title}}</h3>
                        <p style="color: gray">{{ Str::words($item->article, 30) }}</p>
                        <p><b>Kategorija: </b>{{$item->category->name}}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
