<?php

namespace App\Repositories;

use App\Author;
use App\Book;
use App\Category;
use App\Jobs\SetBookCover;
use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Image;

class BookRepository
{
    use DispatchesJobs;

    public function findByVolumeIdOrCreate($bookData)
    {
        $book = Book::where('google_volume_id', $bookData['google_volume_id'])->first();
        if (empty($book)) {
            $book = Book::create($bookData);
            foreach ($bookData['authors'] as $name) {
                $author = Author::firstOrCreate(['name' => $name]);
                $book->authors()->attach($author->id);
            }
            foreach ($bookData['categories'] as $name) {
                $category = Category::firstOrCreate(['name' => $name]);
                $book->categories()->attach($category->id);
            }

            dispatch(new SetBookCover($book));
        }

        // update ratings and ratings count to keep it up to date
        $book->update([
            'google_average_rating' => $bookData['google_average_rating'],
            'google_ratings_count' => $bookData['google_ratings_count']
        ]);
        return $book;
    }

    public function extractGoogleVolumeData($item)
    {
        $result = [
            'google_volume_id' => $item['id'],
            'title' => $item['volumeInfo']['title'],
            'isbn_13' => $item['volumeInfo']['industryIdentifiers'][0]['identifier'] ?? null,
            'isbn_10' => $item['volumeInfo']['industryIdentifiers'][1]['identifier'] ?? null,
            'subtitle' => $item['volumeInfo']['subtitle'],
            'description' => $item['volumeInfo']['description'],
            'publisher' => $item['volumeInfo']['publisher'],
            'published_date' => $item['volumeInfo']['publishedDate'],
            'page_count' => $item['volumeInfo']['pageCount'],
            'google_average_rating' => $item['volumeInfo']['averageRating'],
            'google_ratings_count' => $item['volumeInfo']['ratingsCount'],
            'language' => $item['volumeInfo']['language'],
            'google_info_link' => $item['volumeInfo']['infoLink'],
            'categories' => $item['volumeInfo']['categories'] ?? [],
            'authors' => $item['volumeInfo']['authors'] ?? [],
        ];
        // To avoid "this content should also be served over HTTPS" warning in chrome and firefox
        $image = $item['volumeInfo']['imageLinks']['thumbnail'] ?? null;
        if (!is_null($image)) {
            $image = preg_replace("/^http:/i", "https:", $image);
        }
        $result['image'] = $image;

        return $result;
    }

    public function getMostSaved()
    {
        // TODO: Can we improve this query here?
        return DB::table('book_shelf')
                    ->join('books', 'book_shelf.book_id', '=', 'books.id')
                    ->selectRaw('books.*, count(*) as `aggregate`')
                    ->groupBy('book_shelf.book_id')
                    ->orderBy('aggregate', 'desc')
                    ->distinct('title')
                    ->take(5)
                    ->get();
    }
}
