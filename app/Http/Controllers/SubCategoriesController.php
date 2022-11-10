<?php

namespace App\Http\Controllers;

use App\Models\subCategories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')
        ->where('categories.created_by', (Auth::user()->name))
        ->get();
        return view('categories.addSubCat', ['cats' => $categories]);
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
                'subCatName'   => 'required|unique:sub_categories|string|min:5',
                'category'   => 'required|integer'
            ]
        );

        subCategories::create([
            'subCatName' => $request->subCatName,
            'category_id' =>  $request->category,
        ]);
        session()->flash('Add', 'SubCategory Added Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subCategories  $subCategories
     * @return \Illuminate\Http\Response
     */
    public function show(subCategories $subCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subCategories  $subCategories
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $subCat_id = $request->id;
        $categories = DB::table('categories')
        ->where('categories.created_by', (Auth::user()->name))
        ->get();

        $subCategory    = DB::table('sub_categories')->where('id',$subCat_id)->first();
        if(!empty( $subCategory))
        {
            return view('categories.editSubCat', ['subCat' => $subCategory,'cats' => $categories]);
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
     * @param  \App\Models\subCategories  $subCategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $subCat_id = $request->subCat_id;
        $Validated = $request->validate
        (
            [
                'subCatName'   => 'required|string|min:5|unique:sub_categories,subCatName,'.$subCat_id,
                'category'   => 'required|integer'
            ]
        );
        $affected = DB::table('sub_categories')
        ->where('id',$subCat_id)
        ->update(['subCatName' => $request->subCatName],['category_id' => $request->category]);

        if($affected)
        {
            session()->flash('edit', 'Sub Category Updated Success');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subCategories  $subCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $subCat_id = $request->id;
        $query    = DB::table('sub_categories')->where('id',$subCat_id)->delete();
        if($query)
        {
            session()->flash('delete', ' Sub Category Deleted');
            return back();
        }
    }
}
