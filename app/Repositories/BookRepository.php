<?php

namespace App\Repositories;

use App\Author;
use App\Book;
use App\Category;
use App\Jobs\SetBookCover;
use App\Jobs\SetBookCoverFromAmazon;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Image;
use App\Jobs\SetBookCoverFromGoodreads;

class BookRepository
{
    use DispatchesJobs;

    public function findById($id)
    {
        return Book::find($id);
    }

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
            'google_ratings_count' => $bookData['google_ratings_count'],
        ]);

        return $book;
    }

    public function findByAsinOrCreate($bookData)
    {
        $book = Book::where('asin', $bookData['asin'])->first();
        // if we haven't created the book yet
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
        } else {
            // if we have already stored the book then update couple fields
            $book->description = $bookData['description'] ?? null;
            $book->cover_image = $bookData['cover_image'] ?? null;
            $book->save();
        }
        dispatch((new SetBookCoverFromAmazon($book))->onQueue('books_cover_image_amazon'));

        return $book;
    }

    public function createBookFromGoodreadsData($bookData)
    {

        $book = Book::where('goodreads_id', $bookData['goodreads_id'])->first();
        // if we haven't created the book yet
        if (empty($book)) {
            $book = Book::create($bookData);
            if (is_array($bookData['authors'])) {
                if (isset($bookData['authors']['name'])) {
                    $author = Author::firstOrCreate(['name' => $bookData['authors']['name']]);
                    $book->authors()->attach($author->id);
                } else {
                    foreach ($bookData['authors'] as $authorData) {
                        $author = Author::firstOrCreate(['name' => $authorData['name']]);
                        $book->authors()->attach($author->id);
                    }
                }
            }
            $book->save();
            dispatch((new SetBookCoverFromGoodreads($book))->onQueue('books_cover_image_goodreads'));
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
            'asin' => $item['ASIN'] ?? null,
            'detail_page_url' => $item['DetailPageURL'] ?? null,
            'title' => $item['ItemAttributes']['Title'] ?? null,
            'isbn_10' => $item['ItemAttributes']['ISBN'] ?? null,
            'publisher' => $item['ItemAttributes']['Publisher'] ?? null,
            'published_date' => $item['ItemAttributes']['PublicationDate'] ?? null,
            'page_count' => $item['ItemAttributes']['NumberOfPages'] ?? null,
            'authors' => $item['ItemAttributes']['Author'] ?? [],
            'cover_image' => $item['LargeImage']['URL'] ?? $item['MediumImage']['URL'] ?? null,
        ];

        $description = $this->createDescriptionFromAmazonBookData($item);
        $result['description'] = $description;

        return $result;
    }

    public function extractGoodreadsBookData($item)
    {
        $result = [
            'goodreads_id' => $item['id'],
            'detail_page_url' => $item['link'] ?? null,
            'title' => $item['title'] ?? null,
            'description' => !empty($item['description']) ? $item['description'] : null,
            'publisher' => !empty($item['publisher']) ? $item['publisher'] : null,
            'page_count' => !empty($item['num_pages']) ? $item['num_pages'] : null,
            'authors' => !empty($item['authors']['author']) ? $item['authors']['author'] : [],
            'cover_image' => $item['image_url'] ?? $item['small_image_url'] ?? null,
            'original_image' => $item['image_url'] ?? $item['small_image_url'] ?? null,
        ];
        if (isset($item['isbn']) && !is_array($item['isbn'])) {
            $result['isbn_10'] = $item['isbn'];
        }
        if (isset($item['isbn13']) && !is_array($item['isbn13'])) {
            $result['isbn_13'] = $item['isbn13'];
        }

        if (!empty($item['publisher_year']) && !empty($item['publisher_month']) && !empty($item['publisher_day'])) {
            $result['published_date'] = Carbon::createFromDate(
                $item['publisher_year'],
                $item['publisher_month'],
                $item['publisher_day']
            )->toDateTimeString();
        } elseif (!empty($item['published'])) {
            $result['published_date'] = Carbon::createFromDate($item['published'])->toDateTimeString();
        }

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

    public function getFeatured()
    {
        $me = User::where('username', 'tigran')->first();
        if (empty($me)) {
            return [];
        }
        $shelf = $me->shelves()->where('slug', 'featured')->first();
        if (empty($shelf)) {
            return [];
        }
        $books = $shelf->books()->orderBy('created_at', 'desc')->get();
        $books->load('authors', 'likes');

        return $books;
    }

    public function getFavorites()
    {
        $me = User::where('username', 'tigran')->first();

        if (empty($me)) {
            return [];
        }

        $shelf = $me->shelves()->where('slug', 'favorites')->first();
        if (empty($shelf)) {
            return [];
        }
        $books = $shelf->books()->get();
        $books->load('authors', 'likes');

        return $books;
    }

    private function createDescriptionFromAmazonBookData($item)
    {

        if (isset($item['EditorialReviews']['EditorialReview']["Source"])) {
            $description = $item['EditorialReviews']['EditorialReview']["Content"];
            return $description;
        }

        if (!empty($item['EditorialReviews']['EditorialReview'])) {
            $reviews = $item['EditorialReviews']['EditorialReview'];
            foreach ($reviews as $review) {
                if (!empty($review['Source'])
                    && in_array($review['Source'], ["Product Description", "Amazon.com Review"])) {
                    $description = $review['Content'];
                    return $description;
                }
            }
        }
        return null;
    }
}
