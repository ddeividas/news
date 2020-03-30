<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\ToDoList;
use App\Http\Requests\StoreCategory;
use Illuminate\Support\Facades\Session;
use function foo\func;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $tasks = ToDoList::orderBy('term', 'asc')->get();

        return view('categories.index', compact(['categories', 'tasks']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tasks = ToDoList::orderBy('term', 'asc')->get();
        return view('categories.create', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $categories = new Category();

        $categories->name = $request->input('name');
        $categories->save();

        Session::flash('status', 'Kategorija sukurta');
        Session::flash('status_class', 'alert-success');

        return redirect()->route('category.index');

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
        $category = Category::findOrFail($id);

        $category->delete();

        Session::flash('status', 'Kategorija ištrinta');
        Session::flash('status_class', 'alert-danger');

        return redirect()->back();
    }
}
