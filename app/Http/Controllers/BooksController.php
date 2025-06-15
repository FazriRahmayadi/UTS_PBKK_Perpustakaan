<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $book = Books::all();
        return response()->json([
            'message' => ' book berhasil diambil.',
            'data' => $book
        ]);
    }

    public function show($id)
    {
        $book = Books::find($id);
        if (!$book) {
            return response()->json(['message' => 'book tidak ditemukan.'], 404);
        }
        return response()->json([
            'message' => ' book ditemukan.',
            'data' => $book
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'isbn' => 'required|string',
            'publisher' => 'required|string',
            'year_published' => 'required|string',
            'stock' => 'required|integer',
        ]);

        $book = Books::create([
            'book_id' => Str::ulid()->toBase32(),
            'title' => $validated['title'],
            'isbn' => $validated['isbn'],
            'publisher' => $validated['publisher'],
            'year_published' => $validated['year_published'],
            'stock' => $validated['stock'],
        ]);

        return response()->json([
            'message' => ' book berhasil ditambahkan.',
            'data' => $book
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $book = Books::find($id);
        if (!$book) {
            return response()->json(['message' => 'book tidak ditemukan.'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string',
            'isbn' => 'sometimes|required|string',
            'publisher' => 'sometimes|required|string',
            'year_published' => 'sometimes|required|string',
            'stock' => 'sometimes|required|integer',
        ]);

        $book->update($validated);

        return response()->json([
            'message' => ' book berhasil diperbarui.',
            'data' => $book
        ]);
    }

    public function destroy($id)
    {
        $book = Books::find($id);
        if (!$book) {
            return response()->json(['message' => 'book tidak ditemukan.'], 404);
        }
        $book->delete();

        return response()->json(['message' => ' book berhasil dihapus.']);
    }
}
