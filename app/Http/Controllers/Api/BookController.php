<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return response()->json(
            ['meesage' => 'All books',
            'books' => $books],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|string',
            'description' => 'nullable|max:255|string',
            'author_id' => 'required|integer|exists:authors,id',
            'category_id' => 'required|integer|exists:categories,id',
            'genres' => 'array',
            'cover_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', 
        ]);

        // $book = Book::create($request->only('title', 'author_id', 'category_id', 'description'));

        // Handle the file upload
        $coverPhotoPath = null;
        if ($request->hasFile('cover_photo')) {
            $coverPhotoPath = $request->file('cover_photo')->store('cover_photos', 'public');
        }

        // Create the book entry
        $book = Book::create($request->only('title', 'author_id', 'category_id', 'description') + [
            'cover_photo' => $coverPhotoPath, // Store the file path
        ]);

        error_log("$book");

        if ($request->has('genres')) {
            $book->genres()->attach($request->genres);
        }

        return response()->json(
            [
            'message' => 'book created successfully!',
            'data' => $book,
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $book = Book::find($id);
        $book = Book::with(['author', 'category', 'genres'])->find($id);

        if (!$book) {
            return response()->json(
                [
                    'message' => 'Book not found!',
                ],
                404
            );
        }

        return response()->json(
            [
            'message' => 'book retrived!',
            'book' => $book,
            ],
            200
        );
    }

    public function getBooksByAuthor($authorId)
    {
        // First, find the author
        $author = Author::find($authorId);

        // If the author is found, fetch books manually
        if ($author) {
            // This will fetch books where the author_id matches the author's id
            $books = Book::where('author_id', $author->id)->get();

            return response()->json([
                'author' => $author,
                'books' => $books,
            ], 200);
        }

        return response()->json(['message' => 'Author not found.'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(
                [
                    'message' => 'Book not found!',
                ],
                404
            );
        }

        $request->validate([
            'title' => 'required|max:255|string',
            'description' => 'nullable|max:255|string',
            'author_id' => 'required|integer|exists:authors,id',
            'category_id' => 'required|integer|exists:categories,id'
        ]);

        $book->update([
            'title' => $request->title,
            'description' => $request->description,
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
        ]);

        $book->refresh();

        return response()->json(
            ['message' => 'book updated successfully!',
            'data' => $book],
            200
        );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(
                [
                    'message' => 'Book not found!',
                ],
                404
            );
        }

        $book->delete();

        return response()->json(
            [
                'message' => 'bokk deleted succesfuly',
            ],
            200
        );

    }
}
