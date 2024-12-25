<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json(
            ['message' => 'All categories',
            'categories' => $categories],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'string|required|max:255',
            ]
        );

        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'catgory added successfully',
            'data' => $category
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::width('genre')->find($id);

        return response()->json([
            'data' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = category::find($id);

        if (!$category) {
            return response()->json(
                [
                    'message' => 'catgory not found!'
                ],
                404
            );
        }

        $request->validate([
            'name' => 'string|required|max:255'
        ]);
 
        $category->update([
            'name' => $request->name 
        ]);

        return response()->json(
            [
                'message' => 'catgory updated successfully!',
                'data' => $category
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        
        $category->delete();
    }
}
