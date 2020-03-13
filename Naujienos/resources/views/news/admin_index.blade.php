@extends('layouts.app')

@section('content')
    @if (session('status'))
        {{ session('status') }}
    @endif
    <div class="content">
        <h4>Straipsniai</h4>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th><a href="{{route('news.home', "title")}}">Antraštė</a></th>
                    <th><a href="{{route('news.home', "author")}}">Autorius</a></th>
                    <th>Kategorija</th>
                    <th>Komentarai</th>
                    <th>Peržiūros</th>
                    <th style="text-align: center">Veiksmai</th>
                    <th>Sukurta</th>
                </tr>
            </thead>
            <tbody>
                @foreach($news as $item)
                    <tr>
                        <th>{{$item->id}}</th>
                        <th><a href="{{route('news.show', $item->id)}}">{{$item->title}}</a></th>
                        <th>{{$item->author}}</th>
                        <th>{{$item->category->name}}</th>
                        <th style="text-align: center">{{$item->comments->count()}}</th>
                        <th style="text-align: center">{{$item->views}}</th>
                        <th>
                            <div style="display: flex" class="justify-content-center">
                                <a style="display:block;" class="btn btn-danger" href="{{route('news.delete', $item->id)}}">Trinti</a>
                                @if(Auth::user()->name == $item->author)
                                    <a style="display:block; margin-left: 5px" class="btn btn-primary" href="{{route('news.edit', $item->id)}}">Redaguoti</a>
                                @endif
                            </div>
                        </th>
                        <th>{{$item->created_at->format('d M')}}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
