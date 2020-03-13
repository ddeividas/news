@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <h4 style="margin-top: 40px">Redaguoti užduotį</h4>
                <form method="POST" action="{{route('tasks.update', $task->id)}}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="task">Užduotis</label>
                        <input type="text" class="form-control @error('task') is-invalid @enderror" id="task" name="task" value="{{$task->task}}">
                        @error('task')
                            <div style="color: red; margin-top: 5px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select class="custom-select @error('user') is-invalid @enderror" name="user">
                            @foreach($users as $user)
                                @if($task->user_id == $user->id)
                                    <option selected value="{{$user->id}}">{{$user->name}}</option>
                                @else
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('user')
                            <div style="color: red; margin-top: 5px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="term">Terminas</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="term" name="date" value="{{$task->term}}">
                        @error('user')
                            <div style="color: red; margin-top: 5px">{{ $message }}</div>
                        @enderror
                    </div>
                    <input class="btn btn-primary" type="submit" value="+ Pridėti užduotį">
                </form>
            </div>
        </div>

    </div>
@endsection
