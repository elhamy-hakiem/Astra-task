<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories')
        ->where('categories.created_by', (Auth::user()->name))
        ->get();
        return view('categories.categories', ['cats' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.addCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Validated = $request->validate
        (
            [
                'category_name'    => 'required|unique:categories|string|min:5',
            ]
        );
        Categories::create([
            'category_name' => $request->category_name,
            'created_by' => (Auth::user()->name),
        ]);
        session()->flash('Add', 'Category Added Success');
        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $category_id = $request->id;
        $subCategories = DB::table('sub_categories')
        ->leftJoin('categories', 'sub_categories.category_id', '=', 'categories.id')
        ->select('sub_categories.*','categories.category_name','categories.created_by')
        ->where('sub_categories.category_id', $category_id)
        ->where('categories.created_by', (Auth::user()->name))
        ->get();
        return view('categories.showCategory', ['subCats' => $subCategories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $category_id = $request->id;
        $category    = DB::table('Categories')->where('id',$category_id)->where('created_by',(Auth::user()->name))->first();
        if(!empty( $category))
        {
            return view('categories.editCategory', ['category' => $category]);
        }
        else
        {
            return back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $category_id = $request->category_id;

        $category  = $request->validate
        (
            [
                'category_name'    => 'required|min:5|string|unique:categories,category_name,'.$category_id
            ]
        );

        $affected = DB::table('categories')
        ->where('id',$category_id)
        ->update(['category_name' => $request->category_name],['created_by' => (Auth::user()->name)]);

        if($affected)
        {
            session()->flash('edit', 'Category Updated Success');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category_id = $request->id;
        $query    = DB::table('Categories')->where('id',$category_id)->where('created_by',(Auth::user()->name))->delete();
        if($query)
        {
            session()->flash('delete', 'Category Deleted');
            return redirect('/categories');
        }
    }
}
