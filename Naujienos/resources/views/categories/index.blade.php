
@extends('layouts.app')
@section('content')
    <div class="content">
        <h4>Kategorijos</h4>
        @if($message = Session::get('delete_message'))
            <p style="color: green">{{$message}}</p>
        @endif
        <table style="width: 60%" class="table">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Kategorija</th>
                <th>Straipsniai</th>
                <th>Veiksmai</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th>{{$category->id}}</th>
                    <th>
                        <a href="{{route('news.filter', $category->id)}}">{{$category->name}}</a>
                    </th>
                    <th>{{$category->news->count()}}</th>
                    <th>
                        <form method="POST" action="{{route('category.destroy', $category->id)}}">
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
