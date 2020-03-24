@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
{{--            @if ($errors->any())--}}
{{--                <div class="alert alert-danger">--}}
{{--                    <ul>--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}
            <form method="POST" action="{{route('news.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Antraštė</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                    @error('title')
                        <div style="color: red; margin-top: 5px">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="text">Tekstas</label>
                    <textarea class="form-control @error('text') is-invalid @enderror" id="text" name="text">{{ old('text') }}</textarea>
                    @error('text')
                        <div style="color: red; margin-top: 5px">{{ $message }}</div>
                    @enderror
                </div>
                <select class="custom-select @error('category_id') is-invalid @enderror" name="category_id">
                    <option selected disabled>Pasirinkite kategorija</option>
                    @foreach($categories as $category)
                        @if (old('category_id') == $category->id)
                            <option selected value="{{$category->id}}">{{$category->name}}</option>
                        @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach
                </select>
                @error('category_id')
                    <div style="color: red; margin-top: 5px">{{ $message }}</div>
                @enderror
                <div style="margin-top: 16px" class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="photo" name="photo">
                        <label class="custom-file-label" for="photo">Pasirinkite faila</label>
                    </div>
                </div>
                @error('photo')
                    <div style="color: red; margin-top: 5px">{{ $message }}</div>
                @enderror
                <div>
                    <input type="hidden" value="{{Auth::user()->name}}" name="author">
                </div>
                <div>
                    <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                </div>
                <div>
                    <input style="margin-top: 15px" type="submit" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
@endsection
