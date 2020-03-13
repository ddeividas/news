
@extends('layouts.app')
@section('content')
    <div class="content">
        <h4>{{$user->name}}</h4>
        <div class="row">
            <div class="col-3">
                <img style="width: 100%" src="https://religion.columbia.edu/themes/custom/columbia/assets/img/people-default.svg" alt="">
            </div>
            <div class="col-9">

                <div class="form-group">
                    <label for="name"><b>Vardas</b></label>
                    <input type="text" class="form-control" value="{{$user->name}}" id="name" name="name">
                </div>
                <div style="margin-top: 15px" class="form-group">
                    <label for="email"><b>El-paštas</b></label>
                    <input type="text" class="form-control" value="{{$user->email}}" id="email" name="email">
                </div>
                <div style="margin-top: 15px" class="form-group">
                    <label for="about_me"><b>Apie mane</b></label>
                    <input type="text" class="form-control" value="{{$user->about_me}}" id="about_me" name="about_me">
                </div>
                <form method="post" action="{{route('users.update', $user->id)}}">
                    @csrf
                    @method('put')
                    <input style="margin-top: 20px" type="submit" value="Patvirtinti" class="btn btn-success">
                </form>
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
