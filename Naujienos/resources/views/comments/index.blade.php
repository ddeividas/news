
@extends('layouts.app')
@section('content')
    <div class="content">
        <h4>Visi komentarai</h4>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Vardas</th>
                    <th>Komentaras</th>
                    <th>Straipsnis</th>
                    <th>Sukurta</th>
                    <th>Veiksmai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <th>{{$comment->id}}</th>
                        <th>{{$comment->name}}</th>
                        <th>{{$comment->text}}</th>
                        <th>
                            @if($comment->news)
                            <a href="{{route('news.show', $comment->news->id)}}">{{$comment->news->title}}</a>
                                @endif
                        </th>
                        <th>{{$comment->created_at}}</th>
                        <th>
                            <form method="POST" action="{{route('comments.destroy', $comment->id)}}">
                                @csrf
                                @method('delete')
                                <input class="btn btn-danger" type="submit" value="Trinti">
                            </form>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
