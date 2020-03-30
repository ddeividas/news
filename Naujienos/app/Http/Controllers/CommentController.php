<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\ToDoList;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->only('index', 'destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->get();
        $tasks = ToDoList::orderBy('term', 'asc')->get();

        return view('comments.index', compact(['comments', 'tasks']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comments = new Comment();

        if($request->input('comment')){
            $comments->name = $request->input('name');
            $comments->text = $request->input('comment');
            $comments->news_id = $request->input('news_id');

            $comments->save();

            return redirect()->back()->with('zinute','Komentaras sukurtas sekmingai');
        }
        else{
            return redirect()->back()->with('nepavyko','Iveskite teksta');
        }

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->delete();

        Session::flash('status', 'Komentaras ištrintas');
        Session::flash('status_class', 'alert-success');

        return redirect()->route('comments.index');
    }
}
