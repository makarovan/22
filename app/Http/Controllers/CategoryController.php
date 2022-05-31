<?php
/**
 * Category Controller - CRUD: list, add, edit, delete.
 * 
 * Action array categories - table category
 * Models Categories
 * 
 * @version 1.0
 * @author JKTV20 Makarova 2022
 * @copyright Copyright 2022
 */
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Show list categories in dashboard.
     * 
     * Models category
     * 
     * @return array $categories list of categories
    */
    public function index()
    {
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
     * Show page with all news.
     * 
     * Shows menu with categories, block with news and options for news sorting.
     * 
     * @return array $categories all categories
     * @return array $news all news
     * @return array $sortinglist list of parameters for sorting
     */
    public function listMenu(){
        $categories = Category::orderBy('name', 'asc')->get();
        $news = Task::orderBy('created_at', 'desc')->get();
        $sortinglist=array('all','date asc','date desc','title asc', 'title desc');
        //$categories =  DB::table('categories') ->leftJoin('tasks', 'categories.id', '=', 'tasks.category_id')->select('categories.name', 'categories.id', DB::raw('count(tasks.id) as countTasks'))->groupBy('categories.id')->groupBy('categories.name')->get();
        return view('news', compact('categories', 'news', 'sortinglist'));
    }

    /**
     * Show page with news by one category.
     * 
     * Shows menu with categories, block with news from one category and options for news sorting.
     * 
     * @return array $categories all categories
     * @return Category $categoryName one category
     * @return array $news news from one category
     * @return array $sortinglist list of parameters for sorting
     */
    public function newsByCategory(Category $category){
        $categories = Category::orderBy('name', 'asc')->get();
        $categoryName = Category::find($category->id);
        $sortinglist=array('all','date asc','date desc','title asc', 'title desc');
        $news = Task::where('category_id', $category->id)->orderBy('created_at', 'desc')->get();
        return view('news', compact('categories','news', 'categoryName', 'sortinglist'));
    }

    /**
     * Sort news by date or title.
     * 
     * Sort news by date or title ascending or descending.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param array $data request data
     * @param string $how how the data is sorted
     * @param string $order in what order the data is sorted
     * @return array $categories all categories
     * @return array $news all news
     * @return array $sortinglist list of parameters for sorting
     */
    public function sortNews(Request $request){
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
        //$selectSort = $data['sort'];
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

    /**
     * Search news.
     * 
     * Search news by title, date it was updated at, description
     *  
     * @param  \Illuminate\Http\Request  $request
     * @param array $data request data
     * @param string $text text to be found
     * @return array $categories all categories
     * @return array $sortinglist list of parameters for sorting
     * @return array $news list of news where $text is in title, description or data of update
     */
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
     * Show the form for creating a model category.
     * 
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created model category in table.
     *
     * @param  \Illuminate\Http\Request  $request input from user
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
     * Show the form for editing the model category.
     *
     * @param  \App\Models\Category  $category chosen category
     * @return Category $category the category to edit
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in table category.
     * 
     * An entry was updated in table category
     *
     * @param  \Illuminate\Http\Request  $request input from user with category data
     * @param  \App\Models\Category  $category category to update
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
     * Remove the model category from table.
     *
     * @param  \App\Models\Category  $category category to delete
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/categorylist');
    }

}
