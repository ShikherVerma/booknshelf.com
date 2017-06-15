<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    // like or dislike the book
    public function toggle(Request $request, $bookId)
    {
        $count = DB::table('likes')->where([
            'user_id' => $request->user()->id,
            'book_id' => $bookId,
        ])->count();

        // if user already liked this book then dislike it
        if ($count > 0) {
            return DB::table('likes')->where([
                'user_id' => $request->user()->id,
                'book_id' => $bookId,
            ])->delete();
        }

        // create a new book and like relationship
        $book = Book::findOrFail($bookId);
        $book->likes()->create([
            'user_id' => $request->user()->id,
            'book_id' => $bookId,
        ]);
    }
}
