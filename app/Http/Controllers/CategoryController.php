<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = category::all();

        return response()->json([
            'status' => 'success',
            'category' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            
        ]);
        try {
            // DB::beginTransaction();

            $category = Category::create ([
                'name'  => $request->name,
                'description'=>$request->description,
            ]);

            // DB::commit();

            return response()->json([
                'status' => 'success',
                'category' => $category
            ]);
        } catch (\Throwable $th) {
            // DB::rollback();
            
            Log::error($th);
            return response()->json([
                'status' => 'error',
            ],500);

        }
       
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json([
            'status' => 'success',
            'category' => $category
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'  => 'required|string|max::255',
            'description'=>'required|string|max::255',
        ]);
        $newData =[];

        if(isset($request->name)){
            $newData['name'] =  $request->name;
        }
        if(isset($request->name)){
            $newData['description'] =  $request->description;
        }
        $category->update();

        return response() ->json([
            'status' => 'success',
            'category' => $category
        ]);
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response() ->json([
            'status' => 'success',
        ]);
    }
}
