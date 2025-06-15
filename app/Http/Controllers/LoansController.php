<?php

namespace App\Http\Controllers;

use App\Models\Loans;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class LoansController extends Controller
{
    public function index()
    {
        $loan = Loans::with(['user1', 'books'])->get();

        return response()->json([
            'message' => 'Daftar loan.',
            'data' => $loan
        ]);
    }

    
    public function show($id)
    {
        $loan = Loans::with(['user1', 'books'])->findOrFail($id);

        return response()->json([
            'message' => 'Detail loan.',
            'data' => $loan
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|string|exists:user1,user_id',
            'book_id' => 'required|string|exists:books,book_id',
        ]);

        $loan = Loans::create([
            'loan_id' => Str::ulid()->toBase32(),  
            'user_id' => $validated['user_id'],
            'book_id' => $validated['book_id'],
            
        ]);

        return response()->json([
            'message' => 'Loans berhasil ditambahkan.',
            'data' => $loan
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $loan = Loans::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'sometimes|required|string',
            'book_id' => 'sometimes|required|string',
        ]);

        $loan->update($validated);

        return response()->json([
            'message' => 'Loans berhasil diupdate.',
            'data' => $loan
        ]);
    }

    public function destroy($id)
    {
        $loan = Loans::find($id);
        if (!$loan) {
            return response()->json(['message' => 'Loans tidak ditemukan.'], 404);
        }
        $loan->delete();

        return response()->json(['message' => 'Loans berhasil dihapus.']);
    }
}
