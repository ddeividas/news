@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-8">
            <form method="POST" action="{{route('news.update', $news->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title">Antraštė</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="article" name="title" value="{{old('title', $news->title)}}">
                    @error('title')
                        <div style="color: red; margin-top: 5px">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="text">Tekstas</label>
                    <textarea class="form-control @error('text') is-invalid @enderror" id="article" id="text" name="text">{{old('news', $news->article)}}</textarea>
                    @error('text')
                        <div style="color: red; margin-top: 5px">{{ $message }}</div>
                    @enderror
                </div>
                <select class="custom-select @error('category_id') is-invalid @enderror" name="category_id">
                    <option selected disabled>Pasirinkite kategorija</option>
                    @foreach($categories as $item)
                        @if(old('category_id') == $item->id || $item->id == $news->category_id)
                            <option selected value="{{$item->id}}">{{$item->name}}</option>
                        @else
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif
                    @endforeach
                </select>
                @error('category_id')
                    <div style="color: red; margin-top: 5px">{{ $message }}</div>
                @enderror
                <div style="margin-top: 16px" class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo">
                        <label class="custom-file-label" for="photo">Pasirinkite faila</label>
                    </div>
                </div>
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
