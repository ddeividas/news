@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div style="margin-top: 20px" class="col-11">
            <article>
                <div class="row">
                    <div class="col-8">
                        <div style="width: 100%; height: 300px"><img style="width: 100%; height: 100%" src="/uploads/photos/{{$news->image}}" alt=""></div>
                        <h3 style="max-width: 80%; margin-top: 15px">{{$news->title}}</h3>
                    </div>
                    <div class="col-4">
                        <p style="margin-bottom: 10px"><b>Autorius: </b>
                            <a href="{{route('users.show', $news->users->id)}}">{{$news->author}}</a>
                        @if($news->created_at)
                            <p>Sukurta: {{$news->created_at}}</p>
                            @if($news->created_at != $news->updated_at)
                                <p>Redaguota: {{$news->updated_at}}</p>
                            @endif
                            <p><b>Perskaityta: </b> {{$news->views}}</p>
                        @endif
                        <hr>
                    </div>
                </div>
                <div class="article_top">
                    <p class="article">{{$news->article}}</p>
                </div>
            </article>
        </div>
        <div style="margin-top: 20px" class="col-12 row">
            <div class="col-6">
                <h5>Komentuoti</h5>
                <form method="POST" action="{{route('comments.store')}}">
                    @csrf
                    @guest
                        <div class="form-group">
                            <label for="name">Vardas</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    @else
                        <input type="hidden" name="name" value="{{Auth::user()->name}}">
                    @endif
                    <div class="form-group">
                        @if(Session::get('nepavyko'))
                            <textarea style="border: 1px solid red" class="form-control" name="comment"></textarea>
                        @else
                            <textarea class="form-control" name="comment"></textarea>
                        @endif
                    </div>
                    <div>
                        <input type="hidden" value="{{$news->id}}" name="news_id">
                    </div>
                    <div>
                        <input style="margin-top: 15px" type="submit" class="btn btn-success">
                    </div>
                </form>

                @if($message = Session::get('zinute'))
                    <p style="color: green">{{ $message }}</p>
                @endif
                @if($message = Session::get('nepavyko'))
                    <p style="color: red">{{ $message }}</p>
                @endif
            </div>
            <div class="col-6">
                <h5>Komentarai ({{$news->comments->count()}})</h5>
                @foreach($news->comments as $comment)
                    <div style="margin-bottom: 15px" class="card">
                        <div class="card-header">
                            {{$comment->name}}
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>{{$comment->text}}</p>
                                <footer class="blockquote-footer">{{$comment->created_at}}</footer>
                            </blockquote>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
