<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //all categories
        $categories = Category::orderBy('name', 'asc')->get();

        return view('categories.index', compact('categories'));
    }

    public function listMenu(){
        $categories = Category::orderBy('name', 'asc')->get();
        $news = Task::orderBy('created_at', 'desc')->get();
        $sortinglist=array('all','date asc','date desc','title asc', 'title desc');
        //$categories =  DB::table('categories') ->leftJoin('tasks', 'categories.id', '=', 'tasks.category_id')->select('categories.name', 'categories.id', DB::raw('count(tasks.id) as countTasks'))->groupBy('categories.id')->groupBy('categories.name')->get();
        return view('news', compact('categories', 'news', 'sortinglist'));
    }

    public function newsByCategory(Category $category){
        $categories = Category::orderBy('name', 'asc')->get();
        $categoryName = Category::find($category->id);
        $sortinglist=array('all','date asc','date desc','title asc', 'title desc');
        $news = Task::where('category_id', $category->id)->orderBy('created_at', 'desc')->get();

        $sortinglist=array('all','date asc','date desc','title asc', 'title desc');
        return view('news', compact('categories','news', 'categoryName', 'sortinglist'));
    }

    public function sortNews(Request $request, Category $category){
        $categories = Category::orderBy('name', 'asc')->get();
        $news = Task::orderBy('created_at', 'desc')->get();
        $sortinglist=array('all','date asc','date desc','title asc', 'title desc');
        
        // $categoryName = Category::find($category->id);
        // $where = "";
        //dd($category->id);
        // if($category->id !=null){
        //     $where = "->where('category_id', $category->id)";
        // }

        $data = $request->all();
        //dd($data);
        $selectSort = $data['sort'];
        if($data['sort']=="all"){
            return view('news', compact('categories','news', 'sortinglist'));
        }elseif($data['sort']=="date asc"){
            $how = "updated_at";
            $order = "asc";
        }elseif($data['sort']=="date desc"){
            $how = "updated_at";
            $order = "desc";
        }elseif($data['sort']=="title asc"){
            $how = "title";
            $order = "asc";
        }elseif($data['sort']=="title desc"){
            $how = "title";
            $order = "desc";
        }
        $news = Task::orderBy($how, $order)->get();
        return view('news', compact('categories','news', 'sortinglist'));
    }

    public function search(Request $request){
        $categories = Category::orderBy('name', 'asc')->get();
        $sortinglist=array('all','date asc','date desc','title asc', 'title desc');
        $data = $request->all();
        $text = $data['text'];
        $news = Task::where('title', 'like', '%'.$text.'%')
            ->orwhere('updated_at', 'like', '%'.$text.'%')
            ->orwhere('description', 'like', '%'.$text.'%')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('news', compact('categories','news', 'sortinglist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'name'=>'required'
        ]);
        Category::create($request->all());
        return redirect('/categorylist');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $category->update($request->all());
        return redirect('/categorylist');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/categorylist');
    }

}
