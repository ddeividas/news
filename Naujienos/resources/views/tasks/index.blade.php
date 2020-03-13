@extends('layouts.app')
@section('content')
    <div class="content">


        <div class="row">
            <div class="col-5">
                <h4>{{Auth::user()->name}}</h4>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" style="margin-bottom: 0px">Nauja užduotis</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('tasks.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="task">Užduotis</label>
                                <input type="text" class="form-control @error('task') is-invalid @enderror" id="task" name="task" value="{{ old('task') }}">
                                @error('task')
                                    <div style="color: red; margin-top: 5px">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select class="custom-select @error('user') is-invalid @enderror" name="user">
                                    <option selected disabled>Pasirinkite vartotoja</option>
                                    @foreach($users as $user)
                                        @if(old('user') == $user->id)
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
                                <input type="date" class="form-control @error('date') is-invalid @enderror" id="term" name="date" value="{{ old('date') }}">
                                @error('user')
                                    <div style="color: red; margin-top: 5px">{{ $message }}</div>
                                @enderror
                            </div>
                            <input class="btn btn-primary" type="submit" value="+ Pridėti užduotį">
                        </form>
                    </div>
                </div>
                @if( Session::get('status'))
                    <p style="color: green; margin-top: 15px">Užduotis sėkmingai sukurta!</p>
                @endif
            </div>
            <div style="max-height: 350px; overflow-y: scroll" class="col-7">
                <h4>Tavo užduotys</h4>
                <div class="row">
                    <div style="border-right: 1px solid lightseagreen;" class="col-6">
                        <h5 style="border-bottom: 2px solid black">Esamos užduotys</h5>
                        @foreach($tasks as $task)
                            @if($task->user_id == Auth::user()->id && $task->busena == "neatlikta")
                            <div style="border-bottom: 1px solid black;">
                                <p style="margin-bottom: 0px; margin-top: 8px"><b>Užduotis: </b>{{$task->task}}</p>
                                <p style="margin-bottom: 0px"><b>Iki: </b>{{$task->term}}</p>
                                <form style="margin-top: 0px; margin-bottom: 8px;" method="POST" action="{{route('tasks.change', $task->id)}}">
                                    @csrf
                                    <input type="hidden" value="atlikta" name="status">
                                    <input class="btn btn-success" style="padding: 2px 6px" type="submit" value="Atlikta">
                                </form>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    <div style="border-right: 1px solid lightseagreen" class="col-6">
                        <h5 style="border-bottom: 2px solid black">Atliktos užduotys</h5>
                        @foreach($tasks as $task)
                            @if($task->user_id == Auth::user()->id && $task->busena == "atlikta")
                                <div>
                                    <p style="margin-bottom: 0px; margin-top: 8px"><b>Užduotis: </b>{{$task->task}}</p>
                                    <p style="margin-bottom: 8px"><b>Iki: </b>{{$task->term}}</p>
                                    <div style="display:flex;">
                                        <form style="margin-top: 0px; margin-bottom: 8px;" method="POST" action="{{route('tasks.change', $task->id)}}">
                                            @csrf
                                            <input type="hidden" value="neatlikta" name="status">
                                            <input class="btn btn-primary" style="padding: 2px 6px" type="submit" value="Neatlikta">
                                        </form>
                                        <form method="POST" action="{{route('tasks.destroy', $task->id)}}">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" value="{{$task->id}}" name="id">
                                            <input class="btn btn-danger" style="margin-left: 15px; padding: 2px 6px" type="submit" value="Trinti">
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12">
                <h4 style="margin-top: 40px">Redaguoti užduotį</h4>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Vartotojas</th>
                            <th>Užduotis</th>
                            <th>Terminas</th>
                            <th>Atliko/Neatliko</th>
                            <th>Veiksmas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <th>{{$task->user->name}}</th>
                                <th>{{$task->task}}</th>
                                <th>{{$task->term}}</th>
                                <th>
                                    @if($task->busena == "atlikta")
                                        <span style="color: green">{{$task->busena}}</span>
                                    @else
                                        <span style="color: red">{{$task->busena}}</span>
                                    @endif
                                </th>
                                <th>
                                    <a class="btn btn-primary" href="{{route('tasks.edit', $task->id)}}">Redaguoti</a>
                                </th>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
