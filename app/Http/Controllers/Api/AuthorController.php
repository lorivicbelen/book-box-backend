<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        return response()->json(
            [
                'message' => 'authors retrieved successfully!',
                'authors' => $authors,
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'name' => 'required|max:255|string',
        'bio' => 'nullable|max:255|string'
       ]);
       
       $author = Author::create([
        'name' => $request->name,
        'bio' => $request->bio
       ]);

       return response()->json(
        [
            'message' => 'author added successfully!',
            'data' => $author,
        ],
        200
       );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $author = Author::find($id);

        return response()->json(
            [
                'message' => 'book retrieved successflly!',
                'author' => $author,
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found1',
            ],
        404);
        }

        $request->validate([
            'name' => 'required|max:255|string',
            'bio' => 'nullable|max:255|string'
        ]);

        $author->update([
            'name' => $request->name,
            'bio' => $request->bio
        ]);

        $author->refresh();

        return response()->json(
            [
                'message' => 'Author updated succesfully!',
                'data' => $author,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $author = Author::find($id);

       if(!$author){
            return response()->json(
                [
                    'message' => 'Author not found!'
                ],
                404
            );
       }

       $author->delete();

       return response()->json(
            [
                'message' => 'Author deleted successfuly!',
            ],
            200
        );
    }
}
