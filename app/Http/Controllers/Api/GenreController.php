<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();
        return response()->json(
            ['message' => 'All genres',
            'genres' => $genres],
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

        $genre = Genre::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'genre added successfully',
            'data' => $genre
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $genre = Genre::find($id);

        return response()->json([
            'genres' => $genre
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $genre = genre::find($id);

        if (!$genre) {
            return response()->json(
                [
                    'message' => 'genre not found!'
                ],
                404
            );
        }

        $request->validate([
            'name' => 'string|required|max:255'
        ]);
 
        $genre->update([
            'name' => $request->name 
        ]);

        return response()->json(
            [
                'message' => 'genre updated successfully!',
                'data' => $genre
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $genre = Genre::find($id);
        
        $genre->delete();
    }
}
