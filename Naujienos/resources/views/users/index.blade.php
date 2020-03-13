
@extends('layouts.app')
@section('content')
    <div class="content">
        <h4>Visi komentarai</h4>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Vardas</th>
                <th>El. paštas</th>
                <th>Straipsniai</th>
                <th>Veiksmai</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th>{{$user->id}}</th>
                    <th>
                        <a href="{{route('users.show', $user->id)}}">{{$user->name}}</a>
                    </th>
                    <th>{{$user->email}}</th>
                    <th>{{$user->news->count()}}</th>
                    <th>
                        <form method="POST" action="{{route('users.destroy', $user->id)}}">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Trinti" class="btn btn-danger">
                        </form>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
