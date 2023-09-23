<?php

namespace App\Http\Controllers\V1\Books;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Books\CreateBookForm;
use App\Http\Requests\V1\Books\PatchBookForm;
use App\Http\Requests\V1\Books\UpdateBookForm;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::all();

        return response()->json($books);
    }

    public function store(CreateBookForm $request)
    {
        try {
            Book::make($request->validated())->save();
        } catch (\Throwable $th) {
            report($th);
            return response()->json([
                'success' => false,
                'message' => 'Fail to insert book',
            ], 400);
        }

        return response()->json([], 201);
    }

    public function show(Book $book)
    {
        return response()->json($book);
    }

    public function update(UpdateBookForm $request, Book $book)
    {
        try {
            $book->update($request->validated());
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Fail to update the book',
            ], 400);
        }

        return response()->json($book);
    }

    public function patch(PatchBookForm $request, Book $book)
    {
        try {
            $book->update($request->validated());
        } catch (\Throwable $th) {
            report($th);
            return response()->json([
                'success' => false,
                'message' => 'Fail to update the book',
            ], 400);
        }

        return response()->json($book);
    }

    public function destroy(Book $book)
    {
        try {
            $book->delete();
        } catch (\Throwable $th) {
            report($th);
            return response()->json([
                'success' => false,
                'message' => 'Fail to delete the book',
            ], 400);
        }

        return response()->json();
    }
}
