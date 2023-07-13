<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $books = Books::all();
        return response()->json($books);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'publish_date' => 'required',
        ]);

        $book = new Books();
        $book->name = $request->name;
        $book->author = $request->author;
        $book->publish_date = $request->publish_date;
        $book->save();

        return response()->json([
            'message' => 'Books info created successfully.'
        ], 201);
    }

    public function show($id)
    {
        if(Books::where('id', $id)->exists()) {
            $book = Books::find($id);
            return response()->json($book);
        }
        else {
            return response()->json([
                'message' => 'Books info not found!'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'publish_date' => 'required',
        ]);

        if(Books::where('id', $id)->exists()) {
            $book = Books::find($id);
            $book->name = $request->name;
            $book->author = $request->author;
            $book->publish_date = $request->publish_date;
            $book->save();
            return response()->json([
                'message' => 'Books info updated succeessfully.'
            ], 202);
        }
        else {
            return response()->json([
                'message' => 'Books info not found!'
            ], 404);
        }
    }

    public function destroy($id)
    {
        if(Books::where('id', $id)->exists()) {
            $book = Books::find($id);
            $book->delete();
            return response()->json([
                'message' => 'Books info deleted succeessfully.'
            ], 202);
        }
        else {
            return response()->json([
                'message' => 'Books info not found!'
            ], 404);
        }
    }

}
