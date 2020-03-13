@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-8">
            <form method="POST" action="{{route('news.update', $news->id)}}">
                @csrf
                <div class="form-group">
                    <label for="title">Antraštė</label>
                    <input type="text" class="form-control" id="article" name="title" value="{{$news->title}}">
                </div>
                <div class="form-group">
                    <label for="text">Tekstas</label>
                    <textarea class="form-control" id="text" name="text">{{$news->article}}</textarea>
                </div>
                <select class="custom-select" name="category_id">
                    <option selected disabled>Pasirinkite kategorija</option>
                    @foreach($categories as $item)
                        @if($item->id == $news->category_id)
                            <option selected value="{{$item->id}}">{{$item->name}}</option>
                        @else
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif
                    @endforeach
                </select>
                <div>
                    <input type="hidden" value="{{Auth::user()->name}}" name="author">
                </div>
                <div>
                    <input style="margin-top: 15px" type="submit" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
@endsection
