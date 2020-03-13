@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8" style="padding-top: 20px">
            @if($message = Session::get('categories_create_message'))
                <p style="color: green">{{$message}}</p>
            @elseif($message = Session::get('categories_create_message_cancel'))
                <p style="color: red">{{$message}}</p>
            @endif

            <form method="POST" action="{{route('categories.store')}}">
                @csrf
                <div class="form-group">
                    <label for="category">Pavadinimas</label>
                    <input type="text" class="form-control" id="category" name="name">
                <div>
                    <input style="margin-top: 15px" type="submit" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
@endsection
