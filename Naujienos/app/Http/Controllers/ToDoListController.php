<?php

namespace App\Http\Controllers;

use App\ToDoList;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTasks;
use Illuminate\Support\Facades\Session;

class ToDoListController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = ToDoList::orderBy('term', 'asc')->get();
        $users = User::all();

        return view('tasks.index', compact(['tasks', 'users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTasks $request)
    {
        $tasks = new ToDoList();

        $tasks->task = $request->input('task');
        $tasks->user_id = $request->input('user');
        $tasks->term = $request->input('date');

        $tasks->save();

        Session::flash('status', 'Sėkmingai sukurta užduotis');
        Session::flash('status_class', 'alert-success');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $tasks = ToDoList::orderBy('term', 'asc')->get();
        $task = ToDoList::findOrFail($id);
        $users = User::all();
        return view('tasks.edit', compact(['task', 'users', 'tasks']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTasks $request, $id)
    {
        $tasks = ToDoList::findOrFail($id);

        $tasks->task = $request->input('task');
        $tasks->user_id = $request->input('user');
        $tasks->term = $request->input('date');

        $tasks->save();

        Session::flash('status', 'Sėkmingai atnaujinta užduotis');
        Session::flash('status_class', 'alert-success');

        return redirect()->route('tasks.index');
    }

    public function status(Request $request, $id)
    {
        $tasks = ToDoList::find($id);
        $tasks->busena = $request->input('status');
        $tasks->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tasks = ToDoList::findOrFail($id);

        $tasks->delete();

        Session::flash('status', 'Sėkmingai ištrinta');
        Session::flash('status_class', 'alert-danger');

        return redirect()->back();
    }
}
