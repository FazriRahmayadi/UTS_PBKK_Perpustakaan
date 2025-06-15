<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Book_Authors;
use Illuminate\Http\Request;

class BookAuthorsController extends Controller
{
    public function index()
    {
        $book_author = Book_Authors::with(['books', 'authors'])->get();

        return response()->json([
            'message' => 'Daftar book_author.',
            'data' => $book_author
        ]);
    }


    public function show($id)
    {
        $book_author = Book_Authors::with(['books', 'authors'])->findOrFail($id);

        return response()->json([
            'message' => 'Detail book_author.',
            'data' => $book_author
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|string|exists:books,book_id',
            'author_id' => 'required|string|exists:authors,author_id',
        ]);

        $book_author = Book_Authors::create([
            'id' => Str::ulid()->toBase32(),  
            'book_id' => $validated['book_id'],
            'author_id' => $validated['author_id'],
            
        ]);

        return response()->json([
            'message' => 'Book_Authors berhasil ditambahkan.',
            'data' => $book_author
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $book_author = Book_Authors::findOrFail($id);

        $validated = $request->validate([
            'book_id' => 'sometimes|required|string',
            'author_id' => 'sometimes|required|string',
        ]);

        $book_author->update($validated);

        return response()->json([
            'message' => 'Book_Authors berhasil diupdate.',
            'data' => $book_author
        ]);
    }
    public function destroy($id)
    {
        $book_author = Book_Authors::find($id);
        if (!$book_author) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan.'], 404);
        }
        $book_author->delete();

        return response()->json(['message' => 'Data mahasiswa berhasil dihapus.']);
    }
}
