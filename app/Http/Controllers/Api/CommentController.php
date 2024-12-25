<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Book;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username_id' => 'integer|required|exists:users,id',
            'book_id' => 'integer|required|exists:books,id',
            'comment' => 'required|string|max:255'
        ]);

        $comment = Comment::create([
            'username_id' => $request->username_id,
            'book_id' => $request->book_id,
            'comment' => $request->comment
        ]);

        return response()->json([
            'message' => 'comment posted successfully',
            'data' => $comment
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function getCommentsByBooks($bookId) {
        $book = Book::find($bookId);

        if(!$book) {
            return response()->json(
                [
                    'message' => 'book not found.',
                ],
                404
            );
        }

        $comments = Comment::where('book_id', $book->id)->get();

        return response()->json(
            [
                'data' => $comments
            ]
        );



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
