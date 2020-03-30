<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Category;
use App\User;
use App\ToDoList;
use App\Http\Requests\StoreNews;
use App\Http\Requests\EditNews;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index', 'filter', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::paginate(6);

        $views = News::orderBy('views', 'desc')->paginate(3);

        $categories = Category::all();

        $users = User::all();
        $users = User::with('news')->get()->sortBy(function($item){
            return $item->news->count() * -1;
        });

        return view('news.index', compact(['news', 'categories', 'users', 'views']));
    }

    public function admin_index(){
        $news = News::all();
        $tasks = ToDoList::orderBy('term', 'asc')->get();
        $news = News::orderBy('created_at', 'desc')->get();

        return view('news.admin_index', compact(['news', 'tasks']));
    }

    public function admin_filter($id){
        $tasks = ToDoList::orderBy('term', 'asc')->get();
        $news = News::all();
        $news = News::orderBy($id, 'asc')->get();

        return view('news.admin_index', compact(['news', 'tasks']));
    }

    public function filter($id){
        $news = News::all();
        $categories = Category::all();

        $news = News::where('category_id', '=', $id)->get();

        return view('news.filter', compact(['news', 'categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tasks = ToDoList::orderBy('term', 'asc')->get();

        return view('news.create', compact(['categories', 'tasks']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNews $request)
    {
        $news = new News();

        $news->author = $request->input('author');
        $news->title = $request->input('title');
        $news->article = $request->input('text');
        $news->category_id = $request->input('category_id');
        $news->user_id = $request->input('user_id');

//        --------failo ikelimas
        $image = $request->file('photo');
        $imageExtension = $image->getClientOriginalName();
        $imageName = date('Y_m_d_H') . "." . $imageExtension;
        $image->move('uploads/photos/', $imageName);
        $news->image = $imageName;

        $news->save();

        Session::flash('status', 'Straipsnis sukurtas');
        Session::flash('status_class', 'alert-success');


        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::findOrFail($id);
        $tasks = ToDoList::orderBy('term', 'asc')->get();

        $viewCounter = Session::get('viewed_pages', []);
        if(!in_array($news->id, $viewCounter)){
            $news->increment('views');
            Session::push('viewed_pages', $news->id);
        }/*End of hit counter*/

        return view ('news.show', compact(['news', 'tasks']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = Category::all();
        $tasks = ToDoList::orderBy('term', 'asc')->get();

        return view('news.edit', compact(['news', 'categories', 'tasks']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditNews $request, $id)
    {
        $news = News::findOrFail($id);

        $news->author = $request->input('author');
        $news->title = $request->input('title');
        $news->article = $request->input('text');
        $news->category_id = $request->input('category_id');

        if($request->hasFile('photo')){
            $image = $request->file('photo');
            $imageExtension = $image->getClientOriginalName();
            $imageName = date('Y_m_d_H') . "." . $imageExtension;
            $image->move('uploads/photos/', $imageName);
            $news->image = $imageName;
        }

        $news->update();

        Session::flash('status', 'Straipsnis sėkmingai redaguotas');
        Session::flash('status_class', 'alert-success');

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);

        $news->delete();

        Session::flash('status', 'Straipsnis ištrintas');
        Session::flash('status_class', 'alert-danger');

        return redirect()->back();
    }
}
