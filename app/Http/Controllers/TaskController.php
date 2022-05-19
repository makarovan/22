<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks', 'categories'));
    }

    public function taskByCategory(Request $request){
        $data = $request->all();
        $categories = Category::orderBy('name', 'asc')->get();
        $selectCategory=$data['category_id'];
        if($data['category_id']=="0"){//is chosen All
            return redirect ('/productlist');
        }else{//was chosen category
            $tasks = Task::where('category_id', $data['category_id'])->get();
            return view('tasks.index', compact('tasks', 'categories', 'selectCategory'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('tasks.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'category_id'=>'required'
        ]);
        $data = $request->all();
        $filename = $request->file('image')->getClientOriginalName();
        $data['image'] = $filename;
        Task::create($data);
        $file = $request->file('image');
        if($filename){
            $file->move('../public/images/', $filename);
        }
        return redirect('/productlist');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'category_id'=>'required'
        ]);
        $data = $request->all();
        if($request->file('image')){
            $filename=$request->file('image')->getClientOriginalName();
            $data['image'] = $filename;
            $file= $request->file('image');
            if($filename){
                $file->move('../public/images/', $filename);
            }
        }
        $task->update($data);
        return redirect('/productlist');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/productlist');
    }
}
