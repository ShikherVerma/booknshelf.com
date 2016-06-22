<?php

namespace App\Repositories;

use Image;
use Storage;
use App\Book;
use App\Shelf;
use App\Author;
use App\Category;

class BookRepository
{
    public function findByVolumeIdOrCreate($bookData)
    {
        $book = Book::where('google_volume_id', $bookData['google_volume_id'])->first();
        // TODO: When not storing this book we may consider updating the book to keep it up to date with Google Books API
        if (empty($book)) {
            $book = Book::create($bookData);
            // TODO: Store the cover of the book in local storage or S3?
            // $image = Image::make($book->image);
            // $disk = Storage::disk('public');
            // $disk->put('covers/'.$book->google_volume_id, file_get_contents($image));
            // dd($disk->url('covers/'.$book->google_volume_id));
            foreach ($bookData['authors'] as $name) {
                $author = Author::create(['name' => $name]);
                $book->authors()->attach($author->id);
            }
            foreach ($bookData['categories'] as $name) {
                $category = Category::firstOrCreate(['name' => $name]);
                $book->categories()->attach($category->id);
            }
        }
        return $book;
    }

    public function extractGoogleVolumeData($item)
    {
        return [
                'google_volume_id' => $item['id'],
                'title' => $item['volumeInfo']['title'],
                // 'isbn_10' => $item['volumeInfo']['industryIdentifiers']['ISBN_10'],
                // 'isbn_13' => $item['volumeInfo']['industryIdentifiers']['ISBN_13'],
                'subtitle' => $item['volumeInfo']['subtitle'],
                'description' => $item['volumeInfo']['description'],
                'publisher' => $item['volumeInfo']['publisher'],
                'published_date' => $item['volumeInfo']['publishedDate'],
                'page_count' => $item['volumeInfo']['pageCount'],
                'google_average_rating' => $item['volumeInfo']['averageRating'],
                'google_ratings_count' => $item['volumeInfo']['ratingsCount'],
                'image' => $item['volumeInfo']['imageLinks']['thumbnail'],
                'language' => $item['volumeInfo']['language'],
                'google_info_link' => $item['volumeInfo']['infoLink'],
                'categories' => $item['volumeInfo']['categories'] ?? [],
                'authors' => $item['volumeInfo']['authors'] ?? [],
        ];
    }
}
