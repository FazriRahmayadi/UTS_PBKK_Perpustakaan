<?php

namespace App\Http\Controllers;

use App\Models\User1;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class User1Controller extends Controller
{
    public function index()
    {
        $user = User1::all();
        return response()->json([
            'message' => ' user berhasil diambil.',
            'data' => $user
        ]);
    }

    public function show($id)
    {
        $user = User1::find($id);
        if (!$user) {
            return response()->json(['message' => 'user tidak ditemukan.'], 404);
        }
        return response()->json([
            'message' => ' user ditemukan.',
            'data' => $user
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:50',
            'password' => 'required|string|max:50',
            'membership_date' => 'required|date'
        ]);

        $user = User1::create([
            'user_id' => Str::ulid()->toBase32(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'membership_date' => $validated['membership_date'],
        ]);

        return response()->json([
            'message' => ' user berhasil ditambahkan.',
            'data' => $user
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $user = User1::find($id);
        if (!$user) {
            return response()->json(['message' => 'user tidak ditemukan.'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:50',
            'email' => 'sometimes|required|string|max:50',
            'password' => 'sometimes|required|string|max:50',
            'membership_date' => 'sometimes|required|date',
        ]);

        $user->update($validated);

        return response()->json([
            'message' => ' user berhasil diperbarui.',
            'data' => $user
        ]);
    }

    public function destroy($id)
    {
        $user = User1::find($id);
        if (!$user) {
            return response()->json(['message' => 'user tidak ditemukan.'], 404);
        }
        $user->delete();

        return response()->json(['message' => ' user berhasil dihapus.']);
    }
}
