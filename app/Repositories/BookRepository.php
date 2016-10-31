<?php

namespace App\Repositories;

use App\Author;
use App\Book;
use App\Category;
use App\Jobs\SetBookCover;
use App\Jobs\SetBookCoverFromAmazon;
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
            dispatch((new SetBookCover($book))->onQueue('books_cover_image'));
        }

        // update ratings and ratings count to keep it up to date
        $book->update([
            'google_average_rating' => $bookData['google_average_rating'],
            'google_ratings_count' => $bookData['google_ratings_count']
        ]);
        return $book;
    }

    public function findByAsinOrCreate($bookData)
    {
        $book = Book::where('asin', $bookData['asin'])->first();
        if (empty($book)) {
            $book = Book::create($bookData);
            if (is_array($bookData['authors'])) {
                foreach ($bookData['authors'] as $name) {
                    $author = Author::firstOrCreate(['name' => $name]);
                    $book->authors()->attach($author->id);
                }
            } else {
                $author = Author::firstOrCreate(['name' => $bookData['authors']]);
                $book->authors()->attach($author->id);
            }
            dispatch((new SetBookCoverFromAmazon($book))->onQueue('books_cover_image_amazon'));
        }
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

    public function extractAmazonBookData($item)
    {
        $result = [
            'asin' => $item['ASIN'],
            'detail_page_url' => $item['DetailPageURL'] ?? null,
            'title' => $item['ItemAttributes']['Title'],
            'isbn_10' => $item['ItemAttributes']['ISBN'] ?? null,
            'publisher' => $item['ItemAttributes']['Publisher'] ?? null,
            'published_date' => $item['ItemAttributes']['PublicationDate'] ?? null,
            'page_count' => $item['ItemAttributes']['NumberOfPages'] ?? null,
            'authors' => $item['ItemAttributes']['Author'] ?? [],
            'cover_image' => $item['LargeImage']['URL'] ?? $item['MediumImage']['URL'] ?? null,
        ];
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
